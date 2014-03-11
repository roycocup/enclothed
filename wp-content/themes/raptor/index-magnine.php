

								
                    <!-- Inner Content Section starts here -->
                    <div id="inner_content_section">
                                            
						<?php if(!of_get_option('show_magpro_slider_home') || of_get_option('show_magpro_slider_home') == 'true') : ?>  
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
                
                                   <?php if (have_posts()) : ?>
									<?php $count = 0; while (have_posts()) : the_post(); $count++; ?>
                                     
									 <?php if ( $count == 1 )	: ?>						
										
                                        <div <?php post_class('magnine_post1') ?> id="post-<?php the_ID(); ?>">
												<?php if (!of_get_option('show_postthumbnail_magnine') || of_get_option('show_postthumbnail_magnine') == 'true') : ?>
												<div class="magnine_post1_excerpt_img">
												<?php 
													if( has_post_thumbnail() ) {
													$magthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Raptorbigthumb', false, '' );
														echo '<img src="'.$magthumb[0].'" />';
													} else {
														echo '<img src="'.get_template_directory_uri().'/skins/images/1300.png" />';	
													}
												?>
												</div>
												<?php endif; ?> 
                                                
                                                <div class="magnine_post1_title">
                                                    <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                                </div>
                                                
                                                <div class="magnine_post1_title">
													<p><?php echo Raptor_get_limited_string(get_the_excerpt(), 150, '...') ?></p>
                                                    <p class="mag_post_excerpt_more"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Read More</a></p>                                                
                                                </div>                                                                                                                                      
                                        </div>
                                     <?php elseif ( $count == 2 )	: ?>
                                     
                                        <div <?php post_class('magnine_post2') ?> id="post-<?php the_ID(); ?>">
												<?php if (!of_get_option('show_postthumbnail_magnine') || of_get_option('show_postthumbnail_magnine') == 'true') : ?>
												<div class="magnine_post2_excerpt_img">
												<?php 
													if( has_post_thumbnail() ) {
													$magthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Raptorthumb', false, '' );
														echo '<img src="'.$magthumb[0].'" />';
													} else {
														echo '<img src="'.get_template_directory_uri().'/skins/images/750.png" />';	
													}
												?>
												</div>
												<?php endif; ?>
                                                
                                                <div class="magnine_post2_title">
                                                    <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                                </div>
                                                
                                                <div class="magnine_post2_title">
													<p><?php echo Raptor_get_limited_string(get_the_excerpt(), 150, '...') ?></p>
                                                    <p class="mag_post_excerpt_more"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Read More</a></p>                                                
                                                </div>                                                                                                                                      
                                        </div> 
                                        
                                     <?php elseif ( $count == 3 )	: ?>
                                     
                                        <div <?php post_class('magnine_post3') ?> id="post-<?php the_ID(); ?>">
												<?php if (!of_get_option('show_postthumbnail_magnine') || of_get_option('show_postthumbnail_magnine') == 'true') : ?>
												<div class="magnine_post2_excerpt_img">
												<?php 
													if( has_post_thumbnail() ) {
													$magthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Raptorthumb', false, '' );
														echo '<img src="'.$magthumb[0].'" />';
													} else {
														echo '<img src="'.get_template_directory_uri().'/skins/images/750.png" />';	
													}
												?>
												</div>
												<?php endif; ?>
                                                
                                                <div class="magnine_post2_title">
                                                    <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                                </div>
                                                
                                                <div class="magnine_post2_title">
													<p><?php echo Raptor_get_limited_string(get_the_excerpt(), 150, '...') ?></p>
                                                    <p class="mag_post_excerpt_more"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">Read More</a></p>                                                
                                                </div>                                                                                                                                      
                                        </div>                                                                            
                                     <?php elseif ( $count == 4 )	: ?>
										<div <?php post_class('mag_post') ?> id="post-<?php the_ID(); ?>">
										
											<div class="magnine_post1_title">
												<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
											</div>

											<div class="magnine_post1_title">
                                                
												<?php if (!of_get_option('show_postthumbnail_magnine') || of_get_option('show_postthumbnail_magnine') == 'true') : ?>
												<div class="mag_post_excerpt_img">
												<?php 
													if( has_post_thumbnail() ) {
													$magthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Raptorthumb', false, '' );
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
                                        
                                     <?php elseif ( $count == 5 || $count == 6 || $count == 8 || $count == 9 )	: ?>
                                        <div <?php post_class('magnine_post5') ?> id="post-<?php the_ID(); ?>">

                                                
												<?php if (!of_get_option('show_postthumbnail_magnine') || of_get_option('show_postthumbnail_magnine') == 'true') : ?>
												<div class="magnine_post2_excerpt_img">
												<?php 
													if( has_post_thumbnail() ) {
													$magthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Raptorthumb', false, '' );
														echo '<img src="'.$magthumb[0].'" />';
													} else {
														echo '<img src="'.get_template_directory_uri().'/skins/images/750.png" />';	
													}
												?>
												</div>
												<?php endif; ?>                                                
                                                
                                                
                                                
                                                <div class="magnine_post5_title">
                                                    <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                                </div>
                                                
                                                                                                                                      
                                        </div>
                                     <?php elseif ( $count == 7 || $count == 10 )	: ?>
                                        <div <?php post_class('magnine_post7') ?> id="post-<?php the_ID(); ?>">
												
												<?php if (!of_get_option('show_postthumbnail_magnine') || of_get_option('show_postthumbnail_magnine') == 'true') : ?>
												<div class="magnine_post2_excerpt_img">
												<?php 
													if( has_post_thumbnail() ) {
													$magthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Raptorthumb', false, '' );
														echo '<img src="'.$magthumb[0].'" />';
													} else {
														echo '<img src="'.get_template_directory_uri().'/skins/images/750.png" />';	
													}
												?>
												</div>
												<?php endif; ?> 
                                                
                                                <div class="magnine_post5_title">
                                                    <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                                </div>
                                                
                                                                                                                                      
                                        </div>                                                                          
									 <?php else : ?>
										<div <?php post_class('mag_post') ?> id="post-<?php the_ID(); ?>">
										
											<div class="magnine_post1_title">
												<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
											</div>

											<div class="magnine_post1_title">
												
												<?php if (!of_get_option('show_postthumbnail_magnine') || of_get_option('show_postthumbnail_magnine') == 'true') : ?>
												<div class="mag_post_excerpt_img">
												<?php 
													if( has_post_thumbnail() ) {
													$magthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Raptorthumb', false, '' );
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
                                     <?php endif; ?>
                                     
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
                
                                        <?php
                                            
											if ( !of_get_option('magnine_catbox_id') ) {
												$cats_ids = '1';
											}else {
												$cats_ids = of_get_option('magnine_catbox_id');
											}
                                            $cats_ids = explode(',',$cats_ids);
                                            for($i=0; $i<count($cats_ids); $i++)
                                            if(isset($cats_ids[0]) && $cats_ids[0]>0)
                                            {
                                        
                                        ?>
                                                        
                                        <div class="magnine_post1">

                                                
                                                <div class="magnine_cat_title">
                                                    <h2><?php echo get_cat_name($cats_ids[$i]); ?></h2>
                                                </div>
                                                
                                                <div class="magnine_cat_cont">
                                                
                                                            <?php

                                                                $the_query = new WP_Query('cat='.$cats_ids[$i].'&posts_per_page=3');
                                                                    if (have_posts()) : while ($the_query->have_posts() ) : $the_query->the_post(); 
															?>
                                                                    
                                                                <div class="magnine_cat_post">

                                                                        
																		<?php if (!of_get_option('show_postthumbnail_magnine') || of_get_option('show_postthumbnail_magnine') == 'true') : ?>
                                                                        <div class="magnine_post2_excerpt_img">
                                                                        <?php 
                                                                            if( has_post_thumbnail() ) {
                                                                            $magthumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'Raptorthumb', false, '' );
                                                                                echo '<img src="'.$magthumb[0].'" />';
                                                                            } else {
                                                                                echo '<img src="'.get_template_directory_uri().'/skins/images/750.png" />';	
                                                                            }
                                                                        ?>
                                                                        </div>
                                                                        <?php endif; ?>                                                                         
                                                                        
                                                                        <div class="magnine_post5_title">
                                                                            <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raptor' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                                                        </div>
                                                                        
                                                                                                                                                              
                                                                </div>                                                                    
                                                                                                                    
                                                			<?php endwhile; endif; wp_reset_postdata();  ?>
                                                </div>                                                                                  
                                        </div>
                                        
                                       <?php
                                            }
                                      ?>	                                                        
                
                        </div>	
                        <!-- Main Content Section ends here -->

                        <!-- Sidebar Section starts here -->
                        <?php get_sidebar(); ?> 
                        <!-- Sidebar Section ends here -->





                    </div>	
                    <!-- Inner Content Section ends here -->
							
								
									
