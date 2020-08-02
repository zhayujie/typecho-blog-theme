<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-mb-12 col-offset-1 col-3 kit-hidden-tb" id="secondary" role="complementary" style="padding-right:0">  
    <div class="post-bar">
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
        <section class="widget">
            <h3 class="widget-title"><?php _e('分类'); ?></h3>
            <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
        </section>
        <?php endif; ?>
        
        <section class="widget" id="widget-directory">    
            <h3 class="widget-title"><?php _e('目录'); ?></h3>
            <div id="directory-content" class="directory-content">
                <div id="directory"></div>
            </div>
        </section>   
    </div>    
</div><!-- end #sidebar -->
