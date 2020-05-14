<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline"><a class="title-color" itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <ul class="post-meta">
            <li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
            <li><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
            <li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
        </ul>
        <div id="post-content" class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
        <?php if(  count($this->tags) > 0 ): ?><p itemprop="keywords" class="tags"><?php _e('标签: '); ?><?php $this->tags(', ', true, 'none'); ?></p><?php endif; ?>
        <div class="post-info">
        <a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="知识共享许可协议" style="border-width:0" src="<?php $this->options->themeUrl('img/cc.png'); ?>" /></a>        <div style="margin-top:8px;">
                本作品由<a href="<?php $this->options->siteUrl(); ?>"> zhayujie </a>创作，采用<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"> 知识共享署名 4.0 国际许可协议 </a>进行许可，转载请务必署名。
            <div>
		</div>
    </article>

    <?php $this->need('comments.php'); ?>

    <ul class="post-near">
        <li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
        <li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
    </ul>
</div><!-- end #main-->
<?php $this->need('post-sidebar.php'); ?>
<?php $this->need('footer.php'); ?>

