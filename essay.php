<?php
/**
 * 随笔页面模板
 *
 * @package custom
 */
?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-8" id="main" role="main">
    <?php $this->widget('Widget_Archive@index', 'type=category', 'mid=19')->to($categoryPosts); ?>
    <?php while($categoryPosts->next()): ?>
        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
			<h2 class="post-title" itemprop="name headline"><a class="title-color" itemprop="url" href="<?php $categoryPosts->permalink() ?>"><?php $categoryPosts->title() ?></a></h2>
			<ul class="post-meta">
                <li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $categoryPosts->author->permalink(); ?>" rel="author"><?php $categoryPosts->author(); ?></a></li>
                <li><?php _e('时间: '); ?><time datetime="<?php $categoryPosts->date('c'); ?>" itemprop="datePublished"><?php $categoryPosts->date(); ?></time></li>
                <li><?php _e('分类: '); ?><?php $categoryPosts->category(','); ?></li>
                <li itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $categoryPosts->permalink() ?>#comments"><?php $categoryPosts->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a></li>
                <li>阅读: <?php echo getViews($categoryPosts->cid); ?> 次</li>
            </ul>
            <div class="post-content" itemprop="articleBody">
    			<?php $categoryPosts->content('- 阅读剩余部分 -'); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div><!-- end #main-->

<?php
    // 增加阅读量统计插件对随笔页的兼容
    function getViews($cid)
    {
        $db = Typecho_Db::get();
        $row = $db->fetchRow(
            $db->select('views')->from('table.contents')->where('cid = ?', $cid)
        );
        return $row['views'];
    }
?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>

