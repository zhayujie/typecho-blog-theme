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

<?php if ($this->is('post')): ?>
<script>
var postDirectoryBuild = function() {
    var postChildren = function children(childNodes, reg) {
        var result = [],
            isReg = typeof reg === 'object',
            isStr = typeof reg === 'string',
            node, i, len;
        for (i = 0, len = childNodes.length; i < len; i++) {
            node = childNodes[i];
            if ((node.nodeType === 1 || node.nodeType === 9) &&
                (!reg ||
                isReg && reg.test(node.tagName.toLowerCase()) ||
                isStr && node.tagName.toLowerCase() === reg)) {
                result.push(node);
            }
        }
        return result;
    },
    createPostDirectory = function(article, directory, isDirNum) {
        var contentArr = [],
            titleId = [],
            levelArr, root, level,
            currentList, list, li, link, i, len;
        levelArr = (function(article, contentArr, titleId) {
            var titleElem = postChildren(article.childNodes, /^h\d$/),
                levelArr = [],
                lastNum = 1,
                lastRevNum = 1,
                count = 0,
                guid = 1,
                id = 'directory' + (Math.random() + '').replace(/\D/, ''),
                lastRevNum, num, elem;
            while (titleElem.length) {
                elem = titleElem.shift();
                contentArr.push(elem.innerHTML);
                num = +elem.tagName.match(/\d/)[0];
                if (num > lastNum) {
                    levelArr.push(1);
                    lastRevNum += 1;
                } else if (num === lastRevNum ||
                    num > lastRevNum && num <= lastNum) {
                    levelArr.push(0);
                    lastRevNum = lastRevNum;
                } else if (num < lastRevNum) {
                    levelArr.push(num - lastRevNum);
                    lastRevNum = num;
                }
                count += levelArr[levelArr.length - 1];
                lastNum = num;
                elem.id = elem.id || (id + guid++);
                titleId.push(elem.id);
            }
            if (count !== 0 && levelArr[0] === 1) levelArr[0] = 0;

            return levelArr;
        })(article, contentArr, titleId);
        currentList = root = document.createElement('ul');
        for (i = 0, len = levelArr.length; i < len; i++) {
            level = levelArr[i];
            if (level === 1) {
                list = document.createElement('ul');
                if (!currentList.lastElementChild) {
                    currentList.appendChild(document.createElement('li'));
                }
                currentList.lastElementChild.appendChild(list);
                currentList = list;
            } else if (level < 0) {
                level *= 2;
                while (level++) {
                    currentList = currentList.parentNode;
                }
            }
            li = document.createElement('li');
            link = document.createElement('a');
            link.href = '#' + titleId[i];
            link.innerHTML =  contentArr[i] ;
            li.appendChild(link);
            currentList.appendChild(li);
        }
        directory.appendChild(root);
    };
    createPostDirectory(document.getElementById('post-content'),document.getElementById('directory'), true);
};
postDirectoryBuild();

// 页面滚动到一定高度时 固定目录
var oDiv = document.getElementById("widget-directory"),
    H = 0,
    Y = oDiv        
while (Y) {
    H += Y.offsetTop; 
    Y = Y.offsetParent;
}
window.onscroll = function()
{
    var offset = 20,  margin = 16;
    var s = document.body.scrollTop || document.documentElement.scrollTop
    if(s + offset + margin > H) {
        oDiv.style = "position:fixed;top:" + offset + "px;"
    } else {
        oDiv.style = ""
    }
}
</script>
<?php endif; ?>

</body>
</html>
