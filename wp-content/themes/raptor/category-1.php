<?php get_header(); ?>

								
                    <!-- Inner Content Section starts here -->
                    <div id="inner_content_section">
                    
						<?php if(!of_get_option('show_magpro_slider_archive') || of_get_option('show_magpro_slider_archive') == 'true') : ?>  
                            <?php 
								if ( of_get_option('magpro_slider') ) {
									$dslider = of_get_option('magpro_slider');
								} else {
									$dslider = 'cheader';
								}
								get_template_part( 'slider', $dslider ); 
							?>                
                        <?php endif; ?> 
                                            

                        	             
                        <!-- Main Content Section starts here -->
                        <div id="main_content_section_mag">
                        
                        				<div class="archiveheading">
                                        
											<h2>
											
											<?php _e('Archives for : ', 'Raptor') ?>
                                        
                                            <?php 
                                            
                                            if ( is_category() ) {
                                                echo single_cat_title(); 
                                            }elseif ( is_tag() ) {
                                                echo single_tag_title();	
                                            }elseif ( is_date() ) {
                                                echo single_month_title();	
                                            }
                                            
                                            
                                            ?>
                                            
                                            </h2>                                         
                                        
                                        </div>                        
                
                                   <?php if (have_posts()) : ?>
									<?php $count = 0; while (have_posts()) : the_post(); $count++; ?>									
										<div <?php post_class('mag_post') ?> id="post-<?php the_ID(); ?>">
										
											<div class="magnine_post1_title">
												<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
											</div>

											<div class="magnine_post1_title">
                                                
												<?php if (!of_get_option('show_postthumbnail_mag') || of_get_option('show_postthumbnail_mag') == 'true') : ?>
												<div class="mag_post_excerpt_img">
												<?php 
													if( has_post_thumbnail() ) {
													$magthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Raptorbigthumb', false, '' );
														echo '<img src="'.$magthumb[0].'" />';
													} else {
														echo '<img src="'.get_template_directory_uri().'/skins/images/750.png" />';	
													}
												?>
												</div>
												<?php endif; ?>                                                
                                                
                                                <div class="mag_post_excerpt_p">
													<p><?php echo Raptor_get_limited_string(get_the_excerpt(), 150, '...') ?></p>
                                                    <p class="mag_post_excerpt_more"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Read More</a></p>                                                
                                                </div>
                                               
                                                
											</div>																						
																						
										</div>										

									<?php endwhile; ?>
									
												<?php 
													$next_page = get_next_posts_link(__('Previous', 'Raptor')); 
													$prev_pages = get_previous_posts_link(__('Next', 'Raptor'));
													if(!empty($next_page) || !empty($prev_pages)) :
													?>
													<div class="pagination">
														<?php if(!function_exists('wp_pagenavi')) : ?>
														<div class="al"><?php echo $next_page; ?></div>
														<div class="ar"><?php echo $prev_pages; ?></div>
														<?php else : wp_pagenavi(); endif; ?>
													</div><!-- /pagination -->
													<?php endif; ?>
													
												<?php else : ?>
													<div class="nopost">
														<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'Raptor') ?></p>
													 </div><!-- /nopost -->
												<?php endif; ?>
                
                
                        </div>	
                        <!-- Main Content Section ends here -->

                        <!-- Sidebar Section starts here -->
                        <?php get_sidebar(); ?> 
                        <!-- Sidebar Section ends here -->





                    </div>	
                    <!-- Inner Content Section ends here -->
                    
                    <?php get_footer(); ?>
							
								
									
