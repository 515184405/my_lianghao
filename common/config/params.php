<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    //百度编辑器自定义
    'toolbars'=>[[
        'source', //源代码
        // 'anchor', //锚点
        'insertcode', //代码语言3
        'fontfamily', //字体3
        'fontsize', //字号3
        'paragraph', //段落格式3
        'customstyle', //自定义标题3
        'bold', //加粗1
        // 'snapscreen', //截图
        'italic', //斜体1
        'underline', //下划线1
        'strikethrough', //删除线1
        'subscript', //下标1
        'superscript', //上标1
        'fontborder', //字符边框1
        'forecolor', //字体颜色1
        'touppercase', //字母大写1
        'tolowercase', //字母小写1
        'backcolor', //背景色1
        '|',
        'indent', //首行缩进5
        'justifyleft', //居左对齐5
        'justifyright', //居右对齐5
        'justifycenter', //居中对齐5
        'justifyjustify', //两端对齐5
        'lineheight', //行间距5
        'rowspacingtop', //段前距5
        'rowspacingbottom', //段后距5
        'insertorderedlist', //有序列表5
        'insertunorderedlist', //无序列表5
        'fullscreen', //全屏5
        'directionalityltr', //从左向右输入5
        'directionalityrtl', //从右向左输入5
        'pagebreak', //分页5
        'horizontal', //分隔线5
        '|',
        'inserttable', //插入表格2
        'edittable', //表格属性2
        'edittd', //单元格属性2
        'insertrow', //前插入行2
        'insertcol', //前插入列2
        'mergeright', //右合并单元格2
        'mergedown', //下合并单元格2
        'deleterow', //删除行2
        'deletecol', //删除列2
        'splittorows', //拆分成行2
        'splittocols', //拆分成列2
        'splittocells', //完全拆分单元格2
        'deletecaption', //删除表格标题2
        'inserttitle', //插入标题2
        'mergecells', //合并多个单元格2
        'deletetable', //删除表格2
        'insertparagraphbeforetable', //"表格前插入行"2
        '|',
        'simpleupload', //单图上传4
        'insertimage', //多图上传4
        'insertvideo', //视频4
        'attachment', //附件4
        'wordimage', //图片转存4
        '|',
        'imagenone', //默认
        'imageleft', //左浮动
        'imageright', //右浮动
        'imagecenter', //居中
        '|',
        'emotion', //表情4
        'spechars', //特殊字符4
        'map', //Baidu地图4
        //'gmap', //Google地图

        'background', //背景4
        'template', //模板4
        'scrawl', //涂鸦4
        'music', //音乐4
        '|',
        'link', //超链接
        'unlink', //取消链接
        '|',
        'undo', //撤销
        'redo', //重做
        '|',
        'searchreplace', //查询替换
        'formatmatch', //格式刷
        'blockquote', //引用
        'pasteplain', //纯文本粘贴模式
        'selectall', //全选
        //'print', //打印
        'time', //时间
        'date', //日期
        //'help', //帮助
        'insertframe', //插入Iframe
        'edittip ', //编辑提示
        'autotypeset', //自动排版
        //'drafts', // 从草稿箱加载
        //'charts', // 图表

        'removeformat', //清除格式
        'cleardoc', //清空文档
        'preview', //预览
    ]],
    //百度编辑器自定义简单
    'toolbarssimple'=>[[
        //'anchor', //锚点
        'undo', //撤销
        'redo', //重做
        'bold', //加粗

        //'snapscreen', //截图
        'italic', //斜体
        'underline', //下划线
        'strikethrough', //删除线
        'subscript', //下标
        //'fontborder', //字符边框
        'superscript', //上标


        //'insertrow', //前插入行
        //'insertcol', //前插入列
        //'mergeright', //右合并单元格
        //'mergedown', //下合并单元格
        //'deleterow', //删除行
        //'deletecol', //删除列
        //'splittorows', //拆分成行
        //'splittocols', //拆分成列
        //'splittocells', //完全拆分单元格
        //'deletecaption', //删除表格标题
        //'inserttitle', //插入标题
        //'mergecells', //合并多个单元格
        //'deletetable', //删除表格

        //'insertparagraphbeforetable', //"表格前插入行"
        'insertcode', //代码语言
        'fontfamily', //字体
        'fontsize', //字号
        //'paragraph', //段落格式
        //'simpleupload', //单图上传
        //'insertimage', //多图上传
        //'edittable', //表格属性
        //'edittd', //单元格属性
        //'link', //超链接
        //'unlink', //取消链接
        //'emotion', //表情
        //'spechars', //特殊字符
        //'searchreplace', //查询替换
        //'formatmatch', //格式刷
        //'source', //源代码
        //'blockquote', //引用

        //'selectall', //全选
        //'print', //打印

        //'horizontal', //分隔线

        //'time', //时间
        //'date', //日期
        //'map', //Baidu地图
        //'gmap', //Google地图
        //'insertvideo', //视频
        //'help', //帮助
        'indent', //首行缩进
        'justifyleft', //居左对齐
        'justifyright', //居右对齐
        'justifycenter', //居中对齐
        'justifyjustify', //两端对齐
        //'forecolor', //字体颜色
        //'backcolor', //背景色
        //'insertorderedlist', //有序列表
        //'insertunorderedlist', //无序列表
        'fullscreen', //全屏
        //'directionalityltr', //从左向右输入
        //'directionalityrtl', //从右向左输入
        //'rowspacingtop', //段前距
        //'rowspacingbottom', //段后距
        //'pagebreak', //分页
        //'insertframe', //插入Iframe
        //'imagenone', //默认
        //'imageleft', //左浮动
        //'imageright', //右浮动
        //'attachment', //附件
        //'imagecenter', //居中
        //'wordimage', //图片转存
        'lineheight', //行间距
        'edittip ', //编辑提示
        //'customstyle', //自定义标题
        //'autotypeset', //自动排版
        //'webapp', //百度应用
        'touppercase', //字母大写
        'tolowercase', //字母小写
        //'background', //背景
        //'template', //模板
        //'scrawl', //涂鸦
        // 'music', //音乐
        // 'inserttable', //插入表格
        //'drafts', // 从草稿箱加载
        //'charts', // 图表
        'removeformat', //清除格式
        'pasteplain', //纯文本粘贴模式
        'cleardoc', //清空文档
        'preview', //预览
    ]],

    'static_number' => '?v=0.0.5',  //版本号，用于清除静态文件缓存
];
