<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('Powered by <a href="http://www.typecho.org">Typecho</a>'); ?>.	
    <div><a href="http://beian.miit.gov.cn">皖ICP备18021877号-1</a></div>
</footer><!-- end #footer -->

<?php $this->footer(); ?>
</body>
</html>
