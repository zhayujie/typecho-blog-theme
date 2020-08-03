var titleId = []
var titleSize = 0;
var SWITCH_OFFSET = 10;

var switchTitle = function(idName) {
    var top = document.getElementById(idName).offsetTop - SWITCH_OFFSET;
    window.scrollTo(0, top)
}

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
            levelArr, root, level,
            currentList, list, li, link, i, len;
        levelArr = (function(article, contentArr, titleId) {
            var titleElem = postChildren(article.childNodes, /^h\d$/),
                levelArr = [],
                lastNum = 1,
                lastRevNum = 1,
                count = 0,
                guid = 1,
                id = 'title_' + (Math.random() + '').replace(/\D/, ''),
                lastRevNum, num, elem;
            titleSize = titleElem.length;      
            if (titleSize > 0) {
                document.getElementById("widget-directory").style.display="block";
            }

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
                    if (currentList && currentList.parentNode) {
                        currentList = currentList.parentNode;
                    }
                }
            }
            li = document.createElement('li');
            link = document.createElement('a');
            link.id = "dir_" + titleId[i];
            link.href = 'javascript:;';
            link.innerHTML =  contentArr[i];
            link.setAttribute("onclick", "switchTitle('" + titleId[i] + "')");
            // link.onclick = function(){
            //     switchTitle(titleId[i])
            // };
            li.appendChild(link);
            currentList.appendChild(li);
        }
        directory.appendChild(root);
    };
    createPostDirectory(document.getElementById('post-content'),document.getElementById('directory'), true);
};

// 目录初始化
postDirectoryBuild();

// 页面滚动时目录变化逻辑
if (titleSize > 0) {
    var oDiv = document.getElementById("widget-directory"),
        H = 0,
        Y = oDiv        
    while (Y) {
        H += Y.offsetTop; 
        Y = Y.offsetParent;
    }
    window.onscroll = function()
    {
        // 页面滚动到一定高度时 固定目录
        var offset = 20,  margin = 16;
        var pos = document.body.scrollTop || document.documentElement.scrollTop
        if(pos + offset + margin > H) {
            oDiv.style.position = "fixed";
            oDiv.style.top = offset + "px";
        } else {
            oDiv.style.position = "";
            oDiv.style.top = "";
        }

        // 滚动时改变右侧目录样式，scroll位置在两个title之间时表示当前处于第一个title下
        for (i = 0; i < titleId.length; i++) {
            titleOffset = document.getElementById(titleId[i]).offsetTop;
            if (pos + SWITCH_OFFSET + 3 < titleOffset) {
                break;
            }
        }
        if (i > 0) {
            for (j = 0; j < titleId.length; j++) {
                dirElem = document.getElementById("dir_" + titleId[j]);
                if (j == i-1) {
                    dirElem.className = "dir-check";
                } else {
                    dirElem.className = "dir-uncheck"
                }
            }
        }
    }
}
