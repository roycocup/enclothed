<?php
/*
Plugin Name: WooCommerce SagePay Direct Payment Gateway
Plugin URI: http://devicesoftware.com/sagepay-direct-for-woocommerce/
Description: Extends WooCommerce with SagePay Direct payment gateway.
Version: 0.1.7.0
Author: DeviceSoftware
Author URI: http://devicesoftware.com/sagepay-direct-for-woocommerce/

Text Domain: ds-sagepay
Domain Path: /languages/
 * 
*/

/*  Copyright 2012  Devicesoftware  (email : info@devicesoftware.com) 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
* Changelog
* 
* 0.1.7.0
* FIX: Order confirmation now not returning to empty basket
* Feature: Compatible with 2.0.20 and 2.1
* 
*
* 0.1.6.8 - 2014-01-31
* FIX: removed debugging code
* 
* 0.1.6.7 - 2014-01-28
* SECURITY FIX: Cross Site Scripting (XSS) Vulnerability 
* Feature: Added basket contents to Sagepay basket
* MOD: redefined EURO ISO name
* 
* 0.1.6.6 - 2013-06-19
* FIX: MU undefined function ds_active_network_plugins() typo

* 0.1.6.5 - 2013-05-31
* FIX: warning 'in_array' messages appearing
* FIX: SSL hanging on Completed3D page
* 
* 0.1.6.4 - 2013-05-23
* FIX: added multisite support
* 
* 0.1.6.3 - 2013-05-19
* FIX: duplicate requests to SagePay's 3D Secure auth page 
* 
* 0.1.6.2 - 2013-04-12
* FIX: case sensitive issue with 'content-type' header on some Sagepay servers - [MALFORMED - The Vendor or VendorName value is required. (Code: 3034)]
* 
* 0.1.6.1 - 2013-04-03
* FIX: removed active_cards declaration in this version
* 
* 0.1.6 - 2013-02-13
* FIX: Version 2 Woocommerce compatible - (Still using Sessions - will remove in later release)
* FIX: Non numeric return statuses
* 
* 0.1.5 - 2013-01-25
* Feature: Support for SagePay Token (additional plugin)
* FIX: CSS effecting other tables within the order form.
* 
* 0.1.4 - 2012-12-12
* Feature: Localization support
* 
* 0.1.3 - 2012-11-03
* Feature: Check that Woocommerce is active before initializing.
* FIX: Transposed first & last names on Billing & Shipping details.
* Feature: Populated fullname using first & last names from Billing details of registered customer.
* Feature: Added 3D Auth (3D Secure)
*  
* 0.1.1 - 2012-02-12
*   Initial release.
*/

/**
* General Constants    
*/
define('DS_SAGEPAY_VERSION', '0.1.7.0');

if ( !defined('WP_CONTENT_URL') )
    define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');

if ( !defined('WP_PLUGIN_URL') ) 
    define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');   

if ( !defined('WP_CONTENT_DIR') )
    define('WP_CONTENT_DIR', ABSPATH . 'wp-content');

if ( !defined('WP_PLUGIN_DIR') ) 
    define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');
         
define("DS_SAGEPAY_PLUGINPATH", "/" . plugin_basename( dirname(__FILE__) ));

define('DS_SAGEPAY_BASE_URL', WP_PLUGIN_URL . DS_SAGEPAY_PLUGINPATH);

define('DS_SAGEPAY_BASE_DIR', WP_PLUGIN_DIR . DS_SAGEPAY_PLUGINPATH);

    
//Sage pay currently supported credit/debit cards
define('SAGEPAY_CARDTYPES', 'MC,MasterCard,VISA,VISA Credit,DELTA,VISA Debit,UKE,VISA Electron,MAESTRO,Maestro (Switch),AMEX,American Express,DC,Diner\'s Club,JCB,JCB Card,LASER,Laser');
    
//list of currencies this can easily be modified by adding/removing items    
define('SAGEPAY_CURRENCY', 'USD,US Dollar (USD),EUR,Euro (EUR),GBP,GB Pound (GBP)');

define('VPS_PROTOCOL', 2.23);

/**
* Get active network plugins
* 
*/
if(!function_exists('ds_active_network_plugins'))
{
    function ds_active_network_plugins()
    {
        if ( !is_multisite() )
            return false;
        
        $sitewide_plugins = array_keys((array) get_site_option( 'active_sitewide_plugins' ));
        if (!is_array($sitewide_plugins) )
            return false;
            
        return $sitewide_plugins;
    }
}
// check that woocommerce is an active plugin before initializing sagepay payment gateway
if ( in_array( 'woocommerce/woocommerce.php', (array) get_option( 'active_plugins' )  ) || in_array('woocommerce/woocommerce.php', (array) ds_active_network_plugins() ) ) 
{
    add_action('plugins_loaded', 'ds_sagepay_direct_init', 0);
    add_filter('woocommerce_payment_gateways', 'ds_sagepay_direct_add_gateway' );
    
    // localization
    load_plugin_textdomain( 'ds-sagepay', false, DS_SAGEPAY_PLUGINPATH . '/languages' );  
}

/**
* Initial plugin
* 
*/
function ds_sagepay_direct_init() 
{ 
    /**
    * DS Sagepay direct class    
    */
    class DS_Sagepay_Direct extends WC_Payment_Gateway
    {
        public $id = 'sagepaydirect';
        public $icon;
        public $has_fields = true;        
        public $method_title;
        public $title;
        public $settings;
        
        private $plugin = DS_SAGEPAY_BASE_URL;
        
        /**
        * constructor
        * 
        */
        function __construct()
        {                                   
            // gateway urls            
            $this->simulator_url            = 'https://test.sagepay.com/Simulator/VSPDirectGateway.asp';
            $this->test_url                 = 'https://test.sagepay.com/gateway/service/vspdirect-register.vsp';
            $this->live_url                 = 'https://live.sagepay.com/gateway/service/vspdirect-register.vsp';
            
            // 3D callbacks
            $this->simulator_3d_callback    = 'https://test.sagepay.com/Simulator/VSPDirectCallback.asp';
            $this->test_3d_callback         = 'https://test.sagepay.com/gateway/service/direct3dcallback.vsp';
            $this->live_3d_callback         = 'https://live.sagepay.com/gateway/service/direct3dcallback.vsp';
            
            // 3D iframe
            $this->iframe_3d_callback       = $this->plugin . '/pages/3DCallBack.php';
            $this->iframe_3d_redirect       = $this->plugin . '/pages/3DRedirect.php';

            // load form fields
            $this->init_form_fields();                                            

            // initialise settings
            $this->init_settings();
            
            if(is_admin() && is_array($this->settings))
            {            
                // group & tidy available card types
                $cards = array();
                foreach ( $this->settings as $k => $v ) {
                    if(preg_match('/^cardtype-/', $k)){
                        if($v == 'yes')
                            $cards[] = preg_replace('/^cardtype-/', '', $k);
                    }                
                }
            }
            
            // variables            
            $this->icon                     = $this->plugin . '/assets/images/sagepay.png';    
            $this->title                    = $this->settings['title'];
            $this->method_title             = $this->title;
            $this->description              = $this->settings['description'];
            $this->vendor_name              = $this->settings['vendor-name'];
            $this->mode                     = $this->settings['mode'];        
            $this->tx_type                  = $this->settings['tx-type'];
            $this->currency                 = $this->settings['currency'];
            $this->vps_protocol             = VPS_PROTOCOL;
            //$this->active_cards             = $cards;
            $this->debug                    = $this->settings['debug'];    
            $this->debugemail               = $this->settings['debugemail'];
            //$this->force_3dsecure           = $this->settings['force-3dsecure'];
            $this->show_transaction_table   = $this->settings['show-transaction-table'] == 'yes' ? true : false;
            //show basket in sagepay transaction
            $this->add_basket               = $this->settings['send-basket-content'] == 'yes' ? true : false; 
                       
            // actions
            add_action('woocommerce_update_options_payment_gateways', array(&$this, 'process_admin_options'));
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
            
            add_action('woocommerce_receipt_sagepaydirect', array($this, 'auth_3dsecure'));
            add_action('woocommerce_thankyou_sagepaydirect', array($this, 'thankyou_page'));
                        
            // display transaction table
            if ( is_admin() && $this->show_transaction_table )
            {
                add_action( 'add_meta_boxes', array($this, 'create_order_transactions_meta_box') );
                //$this->create_order_transactions_meta_box();
            }
                        
            //set default mode
            if( empty( $this->mode ) ) $this->mode = 'simulator';
            
            // gateway url
            $gateway_url =  $this->mode . '_url';
            $this->gateway_url = $this->$gateway_url;
            
            // 3D Auth callback
            $callback_3d_url  = $this->mode . '_3d_callback';
            $this->callback_3d_url = $this->$callback_3d_url;
                        
        } // end __construct


        /**
         * Admin Panel Options 
         **/       
        public function admin_options()
        {
            echo '<h3>' . __('SagePay Direct', 'ds-sagepay') . '</h3>';
            echo '<p>' . __('SagePay Direct communicates directly with SagePay\'s gateway keeping the look and feel the same throughout the transaction.', 'ds-sagepay') . '</p>';
            echo '<table class="form-table">';
            // generate the settings form.
            $this->generate_settings_html();
            echo '</table><!--/.form-table-->';
        } // end admin_options()     
                
        /**
         * Initialize Gateway Settings Form Fields
         */
        public function init_form_fields()
        {
            
            // mode options
            $mode_options = array( 'simulator' => __('Simulator', 'ds-sagepay'), 'test' => __('Test', 'ds-sagepay'), 'live' => __('Live', 'ds-sagepay'));            
            
            // transaction options
            $tx_options = array('PAYMENT' => __('Payment', 'ds-sagepay'), 'DEFFERRED' => __('Deferred', 'ds-sagepay'), 'AUTHENTICATE' => __('Authenticate', 'ds-sagepay'));
            
            // add available currencies
            $currency_options=array();
            $available_currencies = explode(',', SAGEPAY_CURRENCY);
            for ($i=0; $i < count($available_currencies); $i+=2){
                $currency_options[$available_currencies[$i]] = $available_currencies[$i+1];
            }
            
            //  array to generate admin form
            $this->form_fields = array(
                'enabled' => array(
                                'title' => __( 'Enable/Disable', 'ds-sagepay' ), 
                                'type' => 'checkbox', 
                                'label' => __( 'Enable SagePay Direct', 'ds-sagepay' ), 
                                'default' => 'yes'
                            ), 
                'title' => array(
                                'title' => __( 'Title', 'ds-sagepay' ), 
                                'type' => 'text', 
                                'description' => __( 'This is the title displayed to the user during checkout.', 'ds-sagepay' ), 
                                'default' => __( 'SagePay Direct', 'ds-sagepay' )
                            ),
                'description' => array(
                                'title' => __( 'Description', 'ds-sagepay' ), 
                                'type' => 'textarea', 
                                'description' => __( 'This is the description which the user sees during checkout.', 'ds-sagepay' ), 
                                'default' => __("Payment via SagePay Gateway, you can pay by credit or debit card", 'ds-sagepay')
                            ),
                'vendor-name' => array(
                                'title' => __( 'Vendor Name', 'ds-sagepay' ), 
                                'type' => 'text', 
                                'description' => __( 'Please enter your vendor name provided by SagePay.', 'ds-sagepay' ), 
                                'default' => ''
                            ),
                'mode'      => array(
                                'title' => __('Mode Type', 'ds-sagepay'),
                                'type' => 'select',
                                'options' => $mode_options,
                                'description' => __( 'Select Simulator, Test or Live modes.', 'ds-sagepay' )
                            ),
                'tx-type'      => array(
                                'title' => __('Transition Type', 'ds-sagepay'),
                                'type' => 'select',
                                'options' => $tx_options,
                                'description' => __( 'Select Payment, Deferred or Authenticated.', 'ds-sagepay' )
                            ),
                'show-transaction-table' => array(
                                'title' => __('Admin Order Page', 'ds-sagepay'),
                                'type' => 'checkbox',
                                'label' => __('Show Transaction Table', 'ds-sagepay'),
                                'description' => __( 'displays the transaction process.', 'ds-sagepay' ),
                                'default' => 'yes'
                            ),
                'send-basket-content' => array(
                                'title' => __('SagePay Basket', 'ds-sagepay'),
                                'type' => 'checkbox',
                                'label' => __('Send basket data to SagePay', 'ds-sagepay'),
                                'description' => __( 'includes order contents in a SagePay transaction.', 'ds-sagepay' ),
                                'default' => 'no'
                            ),
                'currency'  =>  array(
                                'title' => __('Gateway Currency', 'ds-sagepay'),
                                'type' => 'select',
                                'options' => $currency_options,
                                'description' => __( 'Select the currency you are using for this payment gateway.', 'ds-sagepay' )
                            )
                );
            
            
            // add available card types to the form field array    
            $available_cardtypes = explode(',', SAGEPAY_CARDTYPES);
            for ($i=0; $i < count($available_cardtypes); $i+=2){
                $this->form_fields['cardtype-' . $available_cardtypes[$i]] = array(
                    'type' => 'checkbox',
                    'label' => $available_cardtypes[$i+1], 
                    'default' => 'yes'
                );
                if($i == 0){
                     $this->form_fields['cardtype-' . $available_cardtypes[$i]]['title'] = __( 'Supported Cards', 'ds-sagepay' );
                }
            }
            $this->form_fields['debug'] = array(
                                'title' => __( 'Debug', 'ds-sagepay' ), 
                                'type' => 'checkbox', 
                                'label' => __( 'Enable logging', 'ds-sagepay' ), 
                                'default' => 'no'
                            );
            $this->form_fields['debugemail'] = array(
                                'title' => __( 'Debug Email Address', 'ds-sagepay' ), 
                                'type' => 'text', 
                                'description' => __( 'Email address to catch debug information.  Only available in <b>Simulator</b> &amp; <b>Test</b> modes.', 'ds-sagepay' ), 
                                'default' =>  get_option('admin_email')
                            );
        } // end init_form_fields()        
        
        /**
         * Payment fields for sagepay direct.
         **/
        function payment_fields() 
        {
            global $woocommerce; 
            
            $checkout = $woocommerce->checkout();
            
            // add available cards
            $card_select = "";
            $available_cardtypes = explode(',', SAGEPAY_CARDTYPES);
            for ($i=0; $i < count($available_cardtypes); $i+=2){
                if($this->settings['cardtype-' . $available_cardtypes[$i]] == 'yes')
                    $card_select .= "<option value='" . $available_cardtypes[$i] . "' >" . $available_cardtypes[$i+1] . "</option>\n";
            }
            
            // create month options and select current month as default
            $month_select = "";
            for ($i=0; $i < 12; $i++){
                $month = sprintf('%02d', $i+1);
                if($month == date('m'))
                    $select = 'selected ';
                else
                    $select = '';
                $month_select .= "<option value='" . $month . "' " . $select . ">" . $month . "</option>\n";
            }    
            
            // create options for valid from and expires on years
            $year_now = date('y');
            $from_year_select = "";
            $until_year_select = "";
            for($y = $year_now; $y > $year_now - 5; $y--){
                $year = sprintf('%02d', $y);
                $from_year_select .= "<option value='" . $year . "' " . $select . ">" . $year . "</option>\n";
            }
            for($y = $year_now; $y < $year_now + 7; $y++){
                $year = sprintf('%02d', $y);
                $until_year_select .= "<option value='" . $year . "' " . $select . ">" . $year . "</option>\n";
            }
            
            // billing fullname 
            $fullname = $checkout->get_value( 'billing_first_name' ) . " " . $checkout->get_value( 'billing_last_name' );
                
            ?>
           
            <table style="width: 75%;">
            <tbody>
            <tr>
            <td><label for="sagepay_direct_fullname"><?php _e('Fullname', 'ds-sagepay') ?> <span class="required">*</span></label></td>
            <td><input id="sagepay_direct_fullname" class="input-text" type="text" value="<?php echo $fullname; ?>" placeholder="<?php _e('Fullname', 'ds-sagepay') ?>" name="sagepay_direct_fullname"></td>
            </tr>
            <tr>
            <td><label for="sagepay_direct_cardtype"><?php _e('Card Type', 'ds-sagepay') ?> <span class="required">*</span></label></td>
            <td>
                <select id="sagepay_direct_cardtype" name="sagepay_direct_cardtype">
                  <?php echo $card_select; ?>
                </select>
            </td>
            </tr>
            <tr>
            <td><label for="sagepay_direct_cardnumber"><?php _e('Card Number', 'ds-sagepay') ?> <span class="required">*</span></label></td>
            <td><input id="sagepay_direct_cardnumber"  name="sagepay_direct_cardnumber" class="input-text" autocomplete="off" type="text" value="" placeholder="<?php _e('Card Number', 'ds-sagepay') ?>"></td>
            </tr>
            <tr>
            <td><label for="sagepay_direct_validfrom_mm"><?php _e('Valid From', 'ds-sagepay') ?> </label></td>
            <td><select id="sagepay_direct_validfrom_mm" name="sagepay_direct_validfrom_mm">
                <?php echo $month_select; ?>
            </select>&nbsp;<select id="sagepay_direct_validfrom_yy" name="sagepay_direct_validfrom_yy">
                <?php echo $from_year_select; ?>
            </select>
            </td>
            </tr>
            <tr>
            <td><label for="sagepay_direct_validuntil_mm"><?php _e('Valid Until', 'ds-sagepay') ?> <span class="required">*</span></label></td>
            <td><select id="sagepay_direct_validuntil_mm" name="sagepay_direct_validuntil_mm">
                <?php echo $month_select; ?>
            </select>&nbsp;<select id="sagepay_direct_validuntil_yy" name="sagepay_direct_validuntil_yy">
                <?php echo $until_year_select; ?>
            </select>
            </td>
            </tr>
            
            <tr>            
            <td><label for="sagepay_direct_cv2"><?php _e('CV2', 'ds-sagepay') ?> <span class="required">*</span></label></td>
            <td><input id="sagepay_direct_cv2"  name="sagepay_direct_cv2" size="4" class="input-text" autocomplete="off" type="text" value="" placeholder="<?php _e('CV2', 'ds-sagepay') ?>">
            <span><?php _e('The last 3 digits on the signature side.', 'ds-sagepay') ?></span></td>            
            </tr>
            </tbody>
            </table> 

            <?php
        }// payment_fields

        /**
        * Validate payment fields
        */
        function validate_fields() 
        { 
            global $woocommerce;

            if(empty($_POST['sagepay_direct_fullname']))
                $woocommerce->add_error(__('SagePay Direct - Fullname required.', 'ds-sagepay'));
            if(empty($_POST['sagepay_direct_cardnumber']))
                $woocommerce->add_error(__('SagePay Direct - Card number required.', 'ds-sagepay'));
            if(empty($_POST['sagepay_direct_cv2']))
                $woocommerce->add_error(__('SagePay Direct - CV2 required.', 'ds-sagepay'));
            if(!$woocommerce->error_count())
            {
                // card information
                $this->add_param('CardHolder', $_POST['sagepay_direct_fullname']);
                $this->add_param('CardNumber', $_POST['sagepay_direct_cardnumber']);
                $this->add_param('StartDate', $_POST["sagepay_direct_validfrom_mm"] . $_POST["sagepay_direct_validfrom_yy"]);
                $this->add_param('ExpiryDate', $_POST["sagepay_direct_validuntil_mm"] . $_POST["sagepay_direct_validuntil_yy"]);
                $this->add_param('CV2', $_POST['sagepay_direct_cv2']);
                $this->add_param('CardType', $_POST['sagepay_direct_cardtype']);
                                                        
                $this->validated = TRUE;
            }
            else
            {
                $this->validated = FALSE;
            }                
        } // end validate_fields
               
        /**
        * sage pay parameters
        */       
        function sagepay_params()
        {                        
            // general parameters
            $this->add_param('VPSProtocol', VPS_PROTOCOL);
            $this->add_param('Vendor', $this->vendor_name);
            $this->add_param('Description', $this->vendor_name);
            $this->add_param('Currency', $this->currency);
            $this->add_param('TxType', $this->tx_type);            
                        
            // total amount
            $this->add_param('Amount', $this->order->order_total);
            
            // customer email
            $this->add_param('CustomerEMail', $this->order->billing_email);
            
            // billing details
            $this->add_param('BillingSurname', $this->order->billing_last_name);
            $this->add_param('BillingFirstnames', $this->order->billing_first_name);
            $this->add_param('BillingAddress1', $this->order->billing_address_1);
            $this->add_param('BillingAddress2', $this->order->billing_address_2);
            $this->add_param('BillingCity', $this->order->billing_city);
            if($this->order->billing_country == 'US')
                $this->add_param('BillingState', $this->order->billing_state);
            else
                $this->add_param('BillingState', '');
            $this->add_param('BillingPostCode', $this->order->billing_postcode);                    
            $this->add_param('BillingCountry', $this->order->billing_country);
            $this->add_param('BillingPhone', $this->order->billing_phone);
            
            // delivery details
            $this->add_param('DeliverySurname', $this->order->shipping_last_name);
            $this->add_param('DeliveryFirstnames', $this->order->shipping_first_name);
            $this->add_param('DeliveryAddress1', $this->order->shipping_address_1);
            $this->add_param('DeliveryAddress2', $this->order->shipping_address_2);
            $this->add_param('DeliveryCity', $this->order->shipping_city);
            if($this->order->shipping_country == 'US')
                $this->add_param('DeliveryState', $this->order->shipping_state);
            else
                $this->add_param('DeliveryState', '');
            $this->add_param('DeliveryPostCode', $this->order->shipping_postcode);                    
            $this->add_param('DeliveryCountry', $this->order->shipping_country);
            // woocommerce doesn't currently support a delivery phone number using billing phone number instead'
            $this->add_param('DeliveryPhone', $this->order->billing_phone);       
            
            if( $this->add_basket )
            {
                $items = $this->order->get_items();
                
                // total count
                $basket = count($items);
                
                foreach($items as $item)
                {
                    if (get_option('woocommerce_enable_sku', true) == 'yes')
                    {
                        // get product
                        $product = get_product( $item['product_id'] );
                                                
                        $sku = $product->get_sku();
                        $desc = $item['name'] . ' [' . $sku . ']';
                    }                        
                    else
                        $desc = $item['name'];
                        
                    $qty = $item['qty'];
                    $line_sub_total = $item['line_subtotal'];
                    $line_sub_tax = $item['line_tax'];
                    $item_value = round($line_sub_total / $qty, 2);
                    $item_tax = round($line_sub_tax / $qty, 2);
                    $item_total = $item_value + $item_tax;
                    $line_total = $line_sub_total + $line_sub_tax;
                    
                    $basket .= ':' . $desc . ':' . $qty . ':' . $item_value . ':' . $item_tax . ':' . $item_total . ':' .$line_total;
                }
                $this->add_param( 'Basket', $basket );
            }
            
        }//end sagepay_params
        /**
        * process payment
        * 
        * @param int $order_id
        */
        function process_payment( $order_id ) 
        {
            global $woocommerce;
            
            // exit if validation fails
            if(! $this->validated) return;
            
            // woocommerce order instance
            $this->order = new WC_Order( $order_id );

            // create new unique vendor tx code
            $this->add_param('VendorTxCode', $this->create_vendor_tx_code());                
            
            // set sagepay parameters
            $this->sagepay_params();
            
            // debug
            $this->send_debug_email( __('SagePay Direct Debug - Process Payment Request', 'ds-sagepay'), "Payment Gateway URL: " . $this->gateway_url . "\n\n3D Secure Callback URL: " . $this->callback_3d_url . "\n\nPayment Gateway Request: " . print_r($this->params, true));
            
            $this->params = apply_filters("sagepay_direct_params", $this->params);
            // convert parameter array in a string
            $param_string = "";
            foreach( $this->params as $key => $value ) 
            {
                $param_string .= "$key=" . urlencode( $value ) . "&";
            }
            $param_string = rtrim( $param_string, "& " );
                        
            // remote post request
            $params = array( 
                'body' => $param_string,
                'method' => 'POST',
                'headers' => array('Content-Type'=> 'application/x-www-form-urlencoded'),
                'sslverify' => false
            );   
            
            // sagepay step 2             
            $response_array = wp_remote_post($this->gateway_url, $params);

            // response handler
            $response = $this->response_handler($response_array);

            // debug
            $this->send_debug_email( __('SagePay Direct Debug - Process Payment Response', 'ds-sagepay'),  "Payment Gateway URL: " . $this->gateway_url . "\n\n3D Secure Callback URL: " . $this->callback_3d_url . "\n\nPayment Gateway Response:" . print_r($response,true));                                        
            
            // sagepay step 4
            return $response;
        } // end process_payment

        /**
        * Response Handler
        * 
        * @param array $response_array
        */
        private function response_handler($response_array)
        {
           global $woocommerce;
           
           if (!isset($_SESSION)) session_start();
            
            $response = array();
            
            // additional information returned for debugging
            $response['VendorTxCode'] = $this->params['VendorTxCode'];
            
            // creation date & time
            $response['Created'] = date('Y-m-d H:i:s');            
            
            // split response array's body into lines
            $lines = preg_split( '/\r\n|\r|\n/', $response_array['body'] );
            foreach($lines as $line){            
                $key_value = preg_split( '/=/', $line, 2 );
                if(count($key_value) > 1)
                    $response[trim($key_value[0])] = trim($key_value[1]);
            }
            
            $process_payment = false;
            //$response_data = $response;
            if(isset($response['3DSecureStatus']) && $this->force_3dsecure == 'yes')
            {
                switch ($response['3DSecureStatus'])
                {
                    case 'OK':
                    case 'NOTCHECKED':
                        $process_payment = true;
                        break;
                    case 'NOAUTH':
                        $woocommerce->add_error(__('Your card is not in the 3D-Secure scheme.', 'ds-sagepay'));
                        break;
                    case 'CANTAUTH':
                        $woocommerce->add_error(__('Your card issuer is not in the 3D-Secure scheme.', 'ds-sagepay'));
                        break;
                    case 'NOTAUTHED':                    
                        $woocommerce->add_error(__('You failed to authenticate with your Issuing Bank.', 'ds-sagepay'));
                        break;
                    case 'ATTEMPTONLY':
                        $woocommerce->add_error(__('You attempted to authenticate but the process did not complete.', 'ds-sagepay'));
                        break;
                    case 'INCOMPLETE':
                        $woocommerce->add_error(__('You failed to authentication was unable to complete.', 'ds-sagepay'));
                        break;
                    case 'MALFORMED':                
                        $woocommerce->add_error(__('There was a problem with the 3D-Secure data.', 'ds-sagepay'));
                        break;
                    default:
                }                
            }
            else
            {
                $process_payment = true;                
            }
                        $transaction_data = array(
                            'tx_type' => $this->tx_type,
                            'order_total' => $this->order->order_total                            
                        );
                        $transaction_data = array_merge($transaction_data, $response);
                       
                        $transaction = serialize($transaction_data);
                        
                        add_post_meta($this->order->id, 'transactions', $transaction);
                        
                                       
            // handle status
            switch($response['Status']){
                case 'OK':
                case 'REGISTERED':
                case 'AUTHENTICATED':  
                    if( $process_payment )
                    {
                        $this->order->add_order_note( __('Sagepay Direct payment completed', 'ds-sagepay') . ' (Transaction ID: ' . $response['VendorTxCode'] . ')' );
                        $this->order->payment_complete();                    
                        
                        $response['result'] = 'success';
                        
                        if (version_compare($woocommerce->version, '2.1', '<')) {
                            $response['redirect'] = add_query_arg('key', $this->order->order_key, add_query_arg('order', $this->order->id, get_permalink(get_option('woocommerce_thanks_page_id'))));                            
                        } else {
                            $response['redirect'] = $this->order->get_checkout_order_received_url();
                        }
                        
                    }
                    else
                    {
                        $response['Status'] == $response['3DSecureStatus'];
                    }

                    break;
                case '3DAUTH':
                    if(isset($response['3DSecureStatus']) && $response['3DSecureStatus'] == 'OK')
                    {
                        if(isset($response['ACSURL']) && isset($response['MD']) && isset($response['PAReq']))
                        {
                            // current checkout -> page with order id and key
                            // $pay_page = add_query_arg('order', $this->order->id, add_query_arg('key', $this->order->order_key,  get_permalink(woocommerce_get_page_id('pay'))));
                            
                            $pay_page = $this->order->get_checkout_payment_url( true );
                                        
                            $_SESSION["MD"]             = $response['MD'];
                            $_SESSION["PAReq"]          = $response['PAReq'];
                            $_SESSION["ACSURL"]         = $response['ACSURL'];
                            $_SESSION["VendorTxCode"]   = $response['VendorTxCode'];
                            $_SESSION["TermURL"]        = $woocommerce->force_ssl( $this->iframe_3d_callback );
                            $_SESSION["Complete3d"]     = $woocommerce->force_ssl( $pay_page );
                                                                                    
                            $response['result'] = 'success';
                            $response['redirect'] = $pay_page;
                        }
                        break;   
                    }                        
                case 'MALFORMED':
                case 'INVALID':
                case 'ERROR':
                case 'NOTAUTHED':
                case 'REJECTED':
                default:
                    if(isset($response['StatusDetail']))
                    {
                        $woocommerce->add_error($response['Status'] . ' - ' . $this->response_statusdetail($response['StatusDetail']));
                    }
                    else
                    {
                        if(isset($response['Status']))
                        {
                            $woocommerce->add_error($response['Status'] . __(' - unknown error.', 'ds-sagepay'));
                        }
                        else
                        {
                            // if no status return sagepay's responce
                            $woocommerce->add_error($response['body']);
                            $response['Status'] = __(' - unknown error.', 'ds-sagepay');
                        }
                        
                    }                            
                    $response['result'] = strtolower($response['Status']);                        
                    break;
            }
            
            // store info with order for later actions
            if(isset($response['VPSTxId'])) update_post_meta($this->order->id, 'VPSTxId', $response['VPSTxId']);
            if(isset($response['VendorTxCode'])) update_post_meta($this->order->id, 'VendorTxCode', $response['VendorTxCode']);            
            if(isset($response['SecurityKey'])) update_post_meta($this->order->id, 'SecurityKey', $response['SecurityKey']);
            if(isset($response['TxAuthNo'])) update_post_meta($this->order->id, 'TxAuthNo', $response['TxAuthNo']);
            
            return $response;            
        } // end response_handler
        
        /**
        * Thank you page
        */
        function thankyou_page() 
        {
            global $woocommerce;           
            if ($this->description) echo wpautop(wptexturize($this->description));
            
            // empty cart in thank you page
            $woocommerce->cart->empty_cart();                        
        } // end thankyou_page
        
        /**
        * Authorise 3D Secure payments
        * 
        * @param int $order_id
        */
        function auth_3dsecure( $order_id ) 
        {
            global $woocommerce;
           session_start(); 
           // woocommerce order instance
           $this->order = new WC_Order( $order_id );            
            
            if(isset($_SESSION["MD"]) && isset($_SESSION["PAReq"]) && isset($_SESSION["ACSURL"]) && isset($_SESSION["TermURL"]))
            {

                $res =  '<iframe src="' . $woocommerce->force_ssl( $this->iframe_3d_redirect ) . '" name="3diframe" width="100%" height="500px" >' .
                        '<!--Non-IFRAME browser support-->' .
                        '<SCRIPT LANGUAGE="Javascript"> function OnLoadEvent() { document.form.submit(); }</SCRIPT>' .
                        '<html><head><title>3D Secure Verification</title></head>' . 
                        '<body OnLoad="OnLoadEvent();">' .
                        '<form name="form" action="'. $_SESSION['ACSURL'] .'" method="post">' .
                        '<input type="hidden" name="PaReq" value="' . $_SESSION['PAReq'] . '"/>' .                
                        '<input type="hidden" name="MD" value="' . $_SESSION['MD'] . '"/>' .
                        '<input type="hidden" name="TermURL" value="' . $_SESSION['TermURL'] . '"/>' .
                        '<NOSCRIPT>' .
                        '<center><p>Please click button below to Authenticate your card</p><input type="submit" value="Go"/></p></center>' .
                        '</NOSCRIPT>' .
                        '</form></body></html>' . 
                        '</iframe>';
                echo $res;                
                                
            } 
            elseif (isset($_POST['MD']) && isset($_POST['PARes']))
            {                
               // remote post request
               $params = array( 
                   'body' => 'MD=' . $_POST['MD'] . '&PaRes=' . $_POST['PARes'],
                   'headers' => array('Content-Type'=> 'application/x-www-form-urlencoded'),
                   'method' => 'POST',
                   'sslverify' => false
               );
               
               $this->add_param('VendorTxCode',  $_SESSION['VendorTxCode']);
                               
               $response_array = wp_remote_post($this->callback_3d_url, $params);
               
               $response = $this->response_handler($response_array);
               
               $this->send_debug_email( __('SagePay Direct Debug - 3D Secure Response', 'ds-sagepay'),  "Payment Gateway URL: " . $this->gateway_url . "\n\n3D Secure Callback URL: " . $this->callback_3d_url . "\n\nPayment Gateway Response:" . print_r($response,true));
               
               if($response['result'] == 'success' )
               {
                   wp_redirect( $response['redirect'] );
               }
               else
               {
                   $woocommerce->show_messages();
                   
                   // empty cart
                   $woocommerce->cart->empty_cart();                        

                   echo apply_filters( 'ds_sagepay_failed_auth', '<a href="' . $this->order->get_checkout_payment_url() . '" >' . __('Click here to try another payment method.', 'ds-sagepay' ) . '</a>');

               }               
            }
        }// end auth_3dsecure

        /**
        * create Meta Box
        */
        public function create_order_transactions_meta_box()
        {
            //add a metabox
            add_meta_box( 'ds-sagepay-order-transaction-content', 
                $this->title, 
                array(&$this, 'order_transaction_content_meta_box'), 
                'shop_order', 'normal', 'default'); 
        }// end meta_box_order_transactions
    
        /**
         * Meta Box content
         */
        public function order_transaction_content_meta_box($post) 
        {
            // add plugin specific stylesheet
            if (function_exists('wp_enqueue_style')) {
                wp_enqueue_style('sagepay', DS_SAGEPAY_BASE_URL.'/assets/css/plugin.css', array(), DS_SAGEPAY_VERSION);
            }
            
            $args = array(
                'post_id' => $post->ID,
                'approve' => 'approve',
                'type' => 'transaction'
            );

            // table header
            echo '<div class="panel-wrap woocommerce"><table class="ds_sagepay_status" cellspacing="0"><thead><tr>
                <th>' . __('Date', 'ds-sagepay') . '</th><th>' . __('Payment Type', 'ds-sagepay') . '</th><th>' . __('Value', 'ds-sagepay') . '</th><th>' . __('Status', 'ds-sagepay') . '</th><th>' . __('Status Detail', 'ds-sagepay') . '</th>
                <th><span class="tips" data-tip="' . __('Address Verification Service /<br /> 3 or 4 digit security code', 'ds-sagepay') . '">' . __('AVS/CV2', 'ds-sagepay') . '</span></th>
                <th><span class="tips" data-tip="' . __('Address Verification', 'ds-sagepay') . '">' . __('Address', 'ds-sagepay') . '</span></th>
                <th><span class="tips" data-tip="' . __('Postcode Verification', 'ds-sagepay') . '">' . __('Postcode', 'ds-sagepay') . '</span></th>
                <th><span class="tips" data-tip="' . __('Card Verification', 'ds-sagepay') . '">' . __('CV2', 'ds-sagepay') . '</span></th>
                <th><span class="tips" data-tip="' . __('3D Authentication', 'ds-sagepay') . '">' . __('3DSec', 'ds-sagepay') . '</span></th>
                <th><span class="tips" data-tip="' . __('Payment Actions', 'ds-sagepay') . '">' . __('Action(s)', 'ds-sagepay') . '</span></th>
                </thead>'; //<th>Live Status</th></tr>
            // table body
            echo '<tbody>';

            $transactions = get_post_meta($post->ID, 'transactions');
            foreach( $transactions as $transaction)
            {
                $transaction_content = unserialize($transaction);
                
                echo '<tr>';
                echo '<td>' . $transaction_content['Created'] . '</td>';
                echo '<td>' . $transaction_content['tx_type'] . '</td>';
                echo '<td>' . $transaction_content['order_total'] . '</td>';
                echo $this->response_status($transaction_content['Status']);
                echo '<td>' . $this->response_statusdetail($transaction_content['StatusDetail']) . '</td>';
                echo '<td>' . $this->response_icon($transaction_content['AVSCV2']) . '</td>';
                echo '<td>' . $this->response_icon($transaction_content['AddressResult']) . '</td>';
                echo '<td>' . $this->response_icon($transaction_content['PostCodeResult']) . '</td>';
                echo '<td>' . $this->response_icon($transaction_content['CV2Result']) . '</td>';
                echo '<td>' . $this->response_icon($transaction_content['3DSecureStatus']) . '</td>';
                echo '<td>' . __('N/A', 'ds-sagepay') . '</td>';
                //echo '<td>' . '<input type="button" class="button" style="text-align: center;" value="Status" name="ds-sagepay-livestatus" />' . '</td>';            
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table></div>';
        }// end order_transaction_content_meta_box
        
        /**
        * pretty status detail for metabox
        * 
        * @param string $response_status
        */
        private function response_statusdetail($response_statusdetail = '')
        {
            $status = preg_split( '/:/', $response_statusdetail, 2 );
            if(count($status) > 1)
            {
                if(is_numeric(trim($status[0])))
                {
                    switch(trim($status[0]))
                    {
                        case 2007: 
                            $result = __('Contacting bank for authorization.', 'ds-sagepay')  . ' (Code: ' . $status[0] . ')';
                            break;
                        case 4026:
                            $result = __(' 3D-Authentication is required.', 'ds-sagepay')  . ' (Code: ' . $status[0] . ')';
                            break;
                        
                        default:
                            $result = $status[1] . ' (Code: ' . trim($status[0]) . ')';
                    }
                    return $result;
                }            
            }
            else
            {
                return $response_statusdetail;
            }
            return $response_status;
        }// end response_statusdetail
        
        /**
        * pretty status detail for metabox
        * 
        * @param string $response_status
        */
        private function response_status($response_status ='')
        {
            $class = "";
            switch( $response_status )
            {
                case 'OK':
                case 'REGISTERED':
                case 'AUTHENTICATED':  
                    $class = 'class="greencell"';
                    break;
                case '3DAUTH':
                    break;
                case 'MALFORMED':
                case 'INVALID':
                case 'ERROR':
                case 'NOTAUTHED':
                case 'REJECTED':                       
                    $class = 'class="redcell"';
                    break;
                default:
                    break;
            }
            return '<td ' . $class . ' >' . $response_status . '</span></td>';
        }// end response_status
        
        /* pretty status detail for metabox
        * 
        * @param string $response_check
        */
        private function response_icon($response_check ='')
        {
            switch( $response_check )
            {
                case 'ALL MATCH':
                    $icon = 'green';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;            
                case 'SECURITY CODE MATCH ONLY':
                    $icon = 'amber';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;            
                case 'ADDRESS MATCH ONLY':
                    $icon = 'amber';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;
                case 'NO DATA MATCHES':
                    $icon = 'red';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;
                case 'DATA NOT CHECKED':        
                    $icon = 'blue';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;
                case 'NOTPROVIDED':
                    $icon = 'empty';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;
                case 'NOTCHECKED':
                    $icon = 'blue';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;
                case 'MATCHED':
                    $icon = 'green';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;            
                case 'OK':
                    $icon = 'green';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;              
                case 'NOTAUTHED':
                    $icon = 'red';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;              
                case 'NOTMATCHED':
                    $icon = 'red';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;            
                default:
                    $icon = 'empty';
                    $tip = $response_check;
                    $alt = strtolower($response_check);
                    break;            
            }
            return '<img class="tips" data-tip="' . $tip .'" alt="' . $alt . '" src="' . DS_SAGEPAY_BASE_URL . '/assets/images/' . $icon . '.png">';
        }// end response_icon
        /**
         * Send debug email
         * 
         * @param string $msg
         **/
        private function send_debug_email( $subject, $msg)
        {
            if($this->debug=='yes' AND $this->mode!='live' AND !empty($this->debugemail)){
                // send debugemail
                wp_mail( $this->debugemail, $subject, $msg );
            }
                
        }// end send_debug_email
        
        /**
        * add sagepay parameters for later processing
        * 
        * @param string $param
        * @param mixed $value
        */
        private function add_param($param, $value) 
        {
            $this->params[$param] = $value;   
        }// end add_param

        /**
        * generate a unique vendorTxCode
        */
        private function create_vendor_tx_code()
        {
            $time_stamp = date("ymdHis");
            $rand_num = rand(0,32000) * rand(0,32000);
            return $this->vendor_name . "-" . $time_stamp . "-" . $rand_num;            
        } // end create_vendor_tx_code
        
        /**
        * plugin's location
        * 
        */
        private function plugin_url()
        {
            return $this->plugin;
        }// end plugin_url
    }
       if(is_admin())
        new DS_Sagepay_Direct();
}

/**
* add sagepay direct to woocommerce methods array for payment gateways
* 
* @param array $methods
*/
function ds_sagepay_direct_add_gateway( $methods ) 
{
    $methods[] = 'DS_Sagepay_Direct'; 
    return $methods;
} // end add_sagepay_direct
?>
