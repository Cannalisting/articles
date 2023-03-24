<?php
/**
 *
 * The template part to add new article.
 *
 * @package   cannalisting
 * @author    cannalisting-theme-author
 * @link      http://cannalisting-theme-author.com/
 */
global $current_user;
$user_identity = $current_user->ID;
$content = esc_html__('Add your article content here.', 'cannalisting_core');
$settings = array('media_buttons' => false,'quicktags' => true);

$article_limit = 0;
if (function_exists('fw_get_db_settings_option')) {
	$article_limit = fw_get_db_settings_option('article_limit');
}

$article_limit = !empty( $article_limit ) ? $article_limit  : 0;

$remaining_articles = cannalisting_get_subscription_meta('subscription_articles', $user_identity);
$remaining_articles = !empty( $remaining_articles ) ? $remaining_articles  : 0;

$remaining_articles = $remaining_articles + $article_limit; //total in package and one free
$placeholder		= fw_get_template_customizations_directory_uri().'/extensions/articles/static/img/thumbnails/placeholder.jpg';

$args = array('posts_per_page' => '-1',
    'post_type' => 'sp_articles',
    'orderby' => 'ID',
    'post_status' => 'publish',
    'author' => $user_identity,
    'suppress_filters' => false
);
$query = new WP_Query($args);
$posted_articles = $query->post_count;

?>
<div id="tg-content" class="tg-content">
    <div class="tg-dashboardbox tg-businesshours">
        <div class="tg-dashboardtitle">
            <h2><?php esc_html_e('Post an article', 'cannalisting_core'); ?></h2>
        </div>
        <?php if (isset($remaining_articles) && $remaining_articles > $posted_articles) { ?>
        <div class="tg-servicesmodal tg-categoryModal">
            <div class="tg-modalcontent">
                <form class="tg-themeform tg-formamanagejobs tg-addarticle sp-dashboard-profile-form">
                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">
                                <div class="form-group">
                                    <input type="text" name="article_title" class="form-control" placeholder="<?php esc_html_e('Article Title', 'cannalisting_core'); ?>">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">
                                <div class="form-group">
                                    <?php wp_editor($content, 'article_detail', $settings); ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <h2><?php esc_html_e('Tags', 'cannalisting_core'); ?></h2>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">
                                <div class="tg-addallowances">
                                    <div class="tg-addallowance">
                                        <div class="form-group">
                                            <input type="text" name="article_tags" class="form-control input-feature" placeholder="<?php esc_html_e('Article Tags', 'cannalisting_core'); ?>">
                                            <a class="tg-btn add-article-tags" href="javascript:;"><?php esc_html_e('Add Now', 'cannalisting_core'); ?></a>
                                        </div>
                                        <ul class="tg-tagdashboardlist sp-feature-wrap">
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left">
                                <div class="tg-upload">
                                    <div class="tg-uploadhead">
                                        <span>
                                            <h3><?php esc_html_e('Upload Featured Image', 'cannalisting_core'); ?></h3>
                                            <i class="fa fa-exclamation-circle"></i>
                                        </span>
                                        <i class="lnr lnr-upload"></i>
                                    </div>
                                    <div class="tg-box">
                                        <label class="tg-fileuploadlabel" for="tg-featuredimage">
                                            <div id="plupload-featured-container">
                                            	<a href="javascript:;" id="upload-featured-image" class="tg-fileinput sp-upload-container">
													<i class="lnr lnr-cloud-upload"></i>
													<span><?php esc_html_e('Or Drag Your Files Here To Upload', 'cannalisting_core'); ?></span>
												</a> 
                                            </div>
                                        </label>
                                        <div class="tg-gallery">
                                        	<div class="tg-galleryimg tg-galleryimg-item">
												<figure>
													<img src="<?php echo esc_url( $placeholder );?>" class="attachment_src" />
													<input type="hidden" class="attachment_id" name="attachment_id" value="">
													<figcaption>
														<i class="fa fa-close del-featured-image" data-placeholder="<?php echo esc_url( $placeholder );?>"></i>
													</figcaption>
												</figure>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </fieldset>
                    <fieldset>
                        <div id="tg-updateall" class="tg-updateall">
                            <div class="tg-holder">
                                <span class="tg-note"><?php esc_html_e('Click to', 'cannalisting_core'); ?> <strong> <?php esc_html_e('Submit Article Button', 'cannalisting_core'); ?> </strong> <?php esc_html_e('to add the article.', 'cannalisting_core'); ?></span>
                                <?php wp_nonce_field('cannalisting_article_nounce', 'cannalisting_article_nounce'); ?>
                                <a class="tg-btn process-article" data-type="add" href="javascript:;"><?php esc_html_e('Submit Article', 'cannalisting_core'); ?></a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php } else {?>
            <div class="tg-dashboardappointmentbox">
                <?php cannalisting_Prepare_Notification::cannalisting_info(esc_html__('Oops', 'cannalisting_core'), esc_html__('You reached to maximum limit of articles post. Please upgrade your package to add more articles.', 'cannalisting_core')); ?>
            </div>
        <?php } ?>
    </div>
</div>
<script type="text/template" id="tmpl-load-article-tags">
    <li>
    <span class="tg-tagdashboard">
    <i class="fa fa-close delete_article_tags"></i>
    <em>{{data}}</em>
    </span>
    <input type="hidden" name="article_tags[]" value="{{data}}">
    </li>
</script>