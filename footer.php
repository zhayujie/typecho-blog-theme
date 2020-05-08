<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<!-- <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.0/jquery.min.js"></script> -->
<footer id="footer" role="contentinfo">
    &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('Powered by <a href="http://www.typecho.org">Typecho</a>'); ?>.	
    <div><a href="http://beian.miit.gov.cn">皖ICP备18021877号-1</a></div>
</footer><!-- end #footer -->
<?php $this->footer(); ?>

<script src="https://cdn.bootcdn.net/ajax/libs/highlight.js/10.0.1/highlight.min.js"></script>
<script type="text/javascript">
    // 关闭自动语言检测
    hljs.configure({languages: []});
    // 渲染highlight代码块
    hljs.initHighlightingOnLoad();
</script>
</body>
</html>
