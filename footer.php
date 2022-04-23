<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('Powered by <a href="http://www.typecho.org">Typecho</a>'); ?>.	
</footer><!-- end #footer -->
<?php $this->footer(); ?>

<?php if ($this->is('post')): ?>
    <script src="<?php $this->options->themeUrl('js/highlight.min.js'); ?>"></script>
    <script type="text/javascript">
        // 关闭自动语言检测
        hljs.configure({languages: []});
        // 渲染highlight代码块
        hljs.initHighlightingOnLoad();
    </script>
    <script src="<?php $this->options->themeUrl('js/directory.js'); ?>"></script>
<?php endif; ?>

</body>
</html>
