日新图库
------

http://pic.ecjtu.net/


API
------

    /api.php/list?[page=1]&[until=124|before=1372561536]

until和before任选其一，until表示直到某个ID，before表示直到某个时间，规则都是小于不等于。before是整数，Unix时间戳。
按所选参数降序，返回如下：

```
{
    "count": 3,
    "list": [
        {
            "pid": "188",
            "category": "4",
            "title": "美拍交大-绿色的梦",
            "description": "",
            "thumb": "pic.ecjtu.net/pic/201505/13/f2e826a99bd31c74bc3f64caf56b6a10.jpg",
            "count": "9",
            "pubdate": "1431521419",
            "click": "381"
        },
        {
            "pid": "187",
            "category": "4",
            "title": "美拍交大-篮球宝贝",
            "description": "",
            "thumb": "pic.ecjtu.net/pic/201505/10/5feb97d6bc225ea5a0bba959a86ca80e.jpg",
            "count": "8",
            "pubdate": "1431264119",
            "click": "380"
        },
        {
            "pid": "186",
            "category": "1",
            "title": "夜访红谷滩-霓虹",
            "description": "",
            "thumb": "pic.ecjtu.net/pic/201504/28/c12b3c6c8014651672f108e319c6e608.jpg",
            "count": "13",
            "pubdate": "1430224546",
            "click": "306"
        }
    ]
}
```

    /api.php/post/186

图集的详细信息，返回如下：

```
{
    "pid": "186",
    "category": "1",
    "title": "夜访红谷滩-霓虹",
    "description": "",
    "keywords": "夜访红谷滩-霓虹",
    "author": "日新视觉摄影",
    "thumb": "pic.ecjtu.net/pic/201504/28/c12b3c6c8014651672f108e319c6e608.jpg",
    "count": "13",
    "pubdate": "1430224546",
    "click": "305",
    "type": "2",
    "pictures": [
        {
            "url": "pic/201504/28/c12b3c6c8014651672f108e319c6e608.jpg",
            "detail": "城市的夜晚，流彩溢光，繁星闪烁的霓虹灯，织成一件华丽的晚妆，就跟随视觉摄影，走进红谷滩区的霓虹世界！"
        },
        {
            "url": "pic/201504/28/85bbf19726cc1e7c4dc8c071bcd67d32.jpg",
            "detail": "等待的人群"
        },
        {
            "url": "pic/201504/28/3dc2eff97f1060e451cd856475c36d6c.jpg",
            "detail": "光影"
        },
        {
            "url": "pic/201504/28/1afca983657ce27ba8158c8c80902e08.jpg",
            "detail": "月色下的冷寂"
        },
        {
            "url": "pic/201504/28/16e2f469f5ad93a0a2bf17ea6960c765.jpg",
            "detail": "相映    摄/张清宇"
        },
        {
            "url": "pic/201504/28/47a78b9652c5b63049a60acc7b45efc4.jpg",
            "detail": "流光"
        },
        {
            "url": "pic/201504/28/394595594fccd51cb30e2164fcb07e6d.jpg",
            "detail": "流光"
        },
        {
            "url": "pic/201504/28/9d121cf11560edb3a21336caf8cf0470.jpg",
            "detail": "灯堡   摄/张清宇"
        },
        {
            "url": "pic/201504/28/07b7887fd717b84846ede1de019b094a.jpg",
            "detail": "冷寂   摄/张清宇"
        },
        {
            "url": "pic/201504/28/f57cb486ddfbce96147aa66dd43a7471.jpg",
            "detail": "摄/姚远"
        },
        {
            "url": "pic/201504/28/785beaf199a515aa80db9b1c27f44e5b.jpg",
            "detail": "摄/姚远"
        },
        {
            "url": "pic/201504/28/a6cb769755fb9485350fc1f8a00f9384.jpg",
            "detail": "摄/孙嘉梁"
        },
        {
            "url": "pic/201504/28/41c597ad738c234aef36a3de1e18f892.jpg",
            "detail": "摄/孙嘉梁"
        }
    ],
    "comments": [
        {
            "pid": "186",
            "time": "1430273253",
            "author": {
                "sid": "",
                "name": "日新网友",
                "avatar": ""
            },
            "text": "漂亮",
        },
        {
            "pid": "186",
            "time": "1430271446",
            "author": {
                "sid": "",
                "name": "日新网友",
                "avatar": ""
            },
            "text": "这个图集好有大片的酷炫感觉",
        },
        {
            "pid": "186",
            "time": "1430230670",
            "author": {
                "sid": "",
                "name": "日新网友",
                "avatar": ""
            },
            "text": "棒( •̀∀•́ )",
        },
        {
            "pid": "186",
            "time": "1430226257",
            "author": {
                "sid": "",
                "name": "日新网友",
                "avatar": ""
            },
            "text": "太棒了",
        }
    ]
}
```

其中评论针整个图集的评论；每张图都有一个detail。

评论的author如果产生自登录过的用户，sid将会是学号，avatar是该用户的头像，name是用户姓名；未登录用户只有name，且是用户自定的。
