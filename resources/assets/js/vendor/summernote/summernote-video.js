!function(a){"function"===typeof define&&define.amd?define(["jquery"],a):a(window.jQuery)}(function(a){var b=a.summernote.renderer.getTemplate(),c=a.summernote.core.range,d=a.summernote.core.dom,e=function(b){var u,c=/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/,d=b.match(c),e=/\/\/instagram.com\/p\/(.[a-zA-Z0-9]*)/,f=b.match(e),g=/\/\/vine.co\/v\/(.[a-zA-Z0-9]*)/,h=b.match(g),i=/\/\/(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/,j=b.match(i),k=/.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/,l=b.match(k),m=/\/\/v\.youku\.com\/v_show\/id_(\w+)\.html/,n=b.match(m),o=/^.+.(mp4|m4v)$/,p=b.match(o),q=/^.+.(ogg|ogv)$/,r=b.match(q),s=/^.+.(webm)$/,t=b.match(s);if(d&&11===d[1].length){var v=d[1];u=a("<iframe>").attr("frameborder",0).attr("src","//www.youtube.com/embed/"+v).attr("width","640").attr("height","360")}else if(f&&f[0].length)u=a("<iframe>").attr("frameborder",0).attr("src",f[0]+"/embed/").attr("width","612").attr("height","710").attr("scrolling","no").attr("allowtransparency","true");else if(h&&h[0].length)u=a("<iframe>").attr("frameborder",0).attr("src",h[0]+"/embed/simple").attr("width","600").attr("height","600").attr("class","vine-embed");else if(j&&j[3].length)u=a("<iframe webkitallowfullscreen mozallowfullscreen allowfullscreen>").attr("frameborder",0).attr("src","//player.vimeo.com/video/"+j[3]).attr("width","640").attr("height","360");else if(l&&l[2].length)u=a("<iframe>").attr("frameborder",0).attr("src","//www.dailymotion.com/embed/video/"+l[2]).attr("width","640").attr("height","360");else if(n&&n[1].length)u=a("<iframe webkitallowfullscreen mozallowfullscreen allowfullscreen>").attr("frameborder",0).attr("height","498").attr("width","510").attr("src","//player.youku.com/embed/"+n[1]);else{if(!(p||r||t))return!1;u=a("<video controls>").attr("src",b).attr("width","640").attr("height","360")}return u[0]},f=function(a){a.focus();var b=c.create();if(b.isOnAnchor()){var e=d.ancestor(b.sc,d.isAnchor);b=c.createFromNode(e)}return b.toString()},g=function(a,b){a.toggleClass("disabled",!b),a.attr("disabled",!b)},h=function(b,c,d){return a.Deferred(function(a){var b=c.find(".note-video-dialog"),e=b.find(".note-video-url"),f=b.find(".note-video-btn");b.one("shown.bs.modal",function(){e.val(d).on("input",function(){g(f,e.val())}).trigger("focus"),f.click(function(c){c.preventDefault(),a.resolve(e.val()),b.modal("hide")})}).one("hidden.bs.modal",function(){e.off("input"),f.off("click"),"pending"===a.state()&&a.reject()}).modal("show")})};a.summernote.addPlugin({name:"video",buttons:{video:function(a){return b.iconButton("fa fa-youtube-play",{event:"showVideoDialog",title:a.video.video,hide:!0})}},dialogs:{video:function(a){var c='<div class="form-group row-fluid"><label>'+a.video.url+' <small class="text-muted">'+a.video.providers+'</small></label><input class="note-video-url form-control span12" type="text" /></div>',d='<button href="#" class="btn btn-primary note-video-btn disabled" disabled>'+a.video.insert+"</button>";return b.dialog("note-video-dialog",a.video.insert,c,d)}},events:{showVideoDialog:function(a,b,c){var d=c.dialog(),g=c.editable(),i=f(g);b.saveRange(g),h(g,d,i).then(function(a){b.restoreRange(g);var c=e(a);c&&b.insertNode(g,c)}).fail(function(){b.restoreRange(g)})}},langs:{"en-US":{video:{video:"Video",videoLink:"Video Link",insert:"Insert Video",url:"Video URL?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion or Youku)"}},"ar-AR":{video:{video:"\u0641\u064a\u062f\u064a\u0648",videoLink:"\u0631\u0627\u0628\u0637 \u0627\u0644\u0641\u064a\u062f\u064a\u0648",insert:"\u0625\u062f\u0631\u0627\u062c \u0627\u0644\u0641\u064a\u062f\u064a\u0648",url:"\u0631\u0627\u0628\u0637 \u0627\u0644\u0641\u064a\u062f\u064a\u0648",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion ou Youku)"}},"ca-ES":{video:{video:"Video",videoLink:"Enlla\xe7 del video",insert:"Inserir video",url:"URL del video?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, o Youku)"}},"cs-CZ":{video:{video:"Video",videoLink:"Odkaz videa",insert:"Vlo\u017eit video",url:"URL videa?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion nebo Youku)"}},"da-DK":{video:{video:"Video",videoLink:"Video Link",insert:"Inds\xe6t Video",url:"Video URL?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion eller Youku)"}},"de-DE":{video:{video:"Video",videoLink:"Video Link",insert:"Video einf\xfcgen",url:"Video URL?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, oder Youku)"}},"es-ES":{video:{video:"Video",videoLink:"Link del video",insert:"Insertar video",url:"\xbfURL del video?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, o Youku)"}},"es-EU":{video:{video:"Bideoa",videoLink:"Bideorako esteka",insert:"Bideo berri bat txertatu",url:"Bideoaren URL helbidea",providers:"(YouTube, Vimeo, Vine, Instagram, edo DailyMotion)"}},"fa-IR":{video:{video:"\u0648\u06cc\u062f\u06cc\u0648",videoLink:"\u0644\u06cc\u0646\u06a9 \u0648\u06cc\u062f\u06cc\u0648",insert:"\u0627\u0641\u0632\u0648\u062f\u0646 \u0648\u06cc\u062f\u06cc\u0648",url:"\u0622\u062f\u0631\u0633 \u0648\u06cc\u062f\u06cc\u0648 \u061f",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, \u06cc\u0627 Youku)"}},"fi-FI":{video:{video:"Video",videoLink:"Linkki videoon",insert:"Lis\xe4\xe4 video",url:"Videon URL-osoite?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion tai Youku)"}},"fr-FR":{video:{video:"Vid\xe9o",videoLink:"Lien vid\xe9o",insert:"Ins\xe9rer une vid\xe9o",url:"URL de la vid\xe9o",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion ou Youku)"}},"he-IL":{video:{video:"\u05e1\u05e8\u05d8\u05d5\u05df",videoLink:"\u05e7\u05d9\u05e9\u05d5\u05e8 \u05dc\u05e1\u05e8\u05d8\u05d5\u05df",insert:"\u05d4\u05d5\u05e1\u05e3 \u05e1\u05e8\u05d8\u05d5\u05df",url:"\u05e7\u05d9\u05e9\u05d5\u05e8 \u05dc\u05e1\u05e8\u05d8\u05d5\u05df",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion \u05d0\u05d5 Youku)"}},"hu-HU":{video:{video:"Vide\xf3",videoLink:"Vide\xf3 hivatkoz\xe1s",insert:"Vide\xf3 besz\xfar\xe1sa",url:"Vide\xf3 URL c\xedme",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, vagy Youku)"}},"id-ID":{video:{video:"Video",videoLink:"Link video",insert:"Sisipkan video",url:"Tautan video",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, atau Youku)"}},"it-IT":{video:{video:"Video",videoLink:"Collegamento ad un Video",insert:"Inserisci Video",url:"URL del Video",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion o Youku)"}},"ja-JP":{video:{video:"\u52d5\u753b",videoLink:"\u52d5\u753b\u30ea\u30f3\u30af",insert:"\u52d5\u753b\u633f\u5165",url:"\u52d5\u753b\u306eURL",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, Youku)"}},"ko-KR":{video:{video:"\ub3d9\uc601\uc0c1",videoLink:"\ub3d9\uc601\uc0c1 \ub9c1\ud06c",insert:"\ub3d9\uc601\uc0c1 \ucd94\uac00",url:"\ub3d9\uc601\uc0c1 URL",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, Youku \uc0ac\uc6a9 \uac00\ub2a5)"}},"nb-NO":{video:{video:"Video",videoLink:"Videolenke",insert:"Sett inn video",url:"Video-URL",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion eller Youku)"}},"nl-NL":{video:{video:"Video",videoLink:"Video link",insert:"Video invoegen",url:"URL van de video",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion of Youku)"}},"pl-PL":{video:{video:"Wideo",videoLink:"Adres wideo",insert:"Wstaw wideo",url:"Adres wideo",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, lub Youku)"}},"pt-BR":{video:{video:"V\xeddeo",videoLink:"Link para v\xeddeo",insert:"Inserir v\xeddeo",url:"URL do v\xeddeo?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, ou Youku)"}},"ro-RO":{video:{video:"Video",videoLink:"Link video",insert:"Insereaz\u0103 video",url:"URL video?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion, sau Youku)"}},"ru-RU":{video:{video:"\u0412\u0438\u0434\u0435\u043e",videoLink:"\u0421\u0441\u044b\u043b\u043a\u0430 \u043d\u0430 \u0432\u0438\u0434\u0435\u043e",insert:"\u0412\u0441\u0442\u0430\u0432\u0438\u0442\u044c \u0432\u0438\u0434\u0435\u043e",url:"URL \u0432\u0438\u0434\u0435\u043e",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion \u0438\u043b\u0438 Youku)"}},"sk-SK":{video:{video:"Video",videoLink:"Odkaz videa",insert:"Vlo\u017ei\u0165 video",url:"URL videa?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion nebo Youku)"}},"sl-SI":{video:{video:"Video",videoLink:"Video povezava",insert:"Vstavi video",url:"Povezava do videa",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion ali Youku)"}},"sr-RS":{video:{video:"\u0412\u0438\u0434\u0435\u043e",videoLink:"\u0412\u0435\u0437\u0430 \u043a\u0430 \u0432\u0438\u0434\u0435\u0443",insert:"\u0423\u043c\u0435\u0442\u043d\u0438 \u0432\u0438\u0434\u0435\u043e",url:"URL \u0432\u0438\u0434\u0435\u043e",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion \u0438\u043b\u0438 Youku)"}},"sr-RS-Latin":{video:{video:"Video",videoLink:"Veza ka videu",insert:"Umetni video",url:"URL video",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion ili Youku)"}},"sv-SE":{video:{video:"Filmklipp",videoLink:"L\xe4nk till filmklipp",insert:"Infoga filmklipp",url:"L\xe4nk till filmklipp",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion eller Youku)"}},"th-TH":{video:{video:"\u0e27\u0e35\u0e14\u0e35\u0e42\u0e2d",videoLink:"\u0e25\u0e34\u0e07\u0e01\u0e4c\u0e02\u0e2d\u0e07\u0e27\u0e35\u0e14\u0e35\u0e42\u0e2d",insert:"\u0e41\u0e17\u0e23\u0e01\u0e27\u0e35\u0e14\u0e35\u0e42\u0e2d",url:"\u0e17\u0e35\u0e48\u0e2d\u0e22\u0e39\u0e48 URL \u0e02\u0e2d\u0e07\u0e27\u0e35\u0e14\u0e35\u0e42\u0e2d?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion \u0e2b\u0e23\u0e37\u0e2d Youku)"}},"tr-TR":{video:{video:"Video",videoLink:"Video ba\u011flant\u0131s\u0131",insert:"Video ekle",url:"Video ba\u011flant\u0131s\u0131?",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion veya Youku)"}},"uk-UA":{video:{video:"\u0412\u0456\u0434\u0435\u043e",videoLink:"\u041f\u043e\u0441\u0438\u043b\u0430\u043d\u043d\u044f \u043d\u0430 \u0432\u0456\u0434\u0435\u043e",insert:"\u0412\u0441\u0442\u0430\u0432\u0438\u0442\u0438 \u0432\u0456\u0434\u0435\u043e",url:"URL \u0432\u0456\u0434\u0435\u043e",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion \u0447\u0438 Youku)"}},"vi-VN":{video:{video:"Video",videoLink:"\u0110\u01b0\u1eddng D\u1eabn \u0111\u1ebfn Video",insert:"Ch\xe8n Video",url:"URL",providers:"(YouTube, Vimeo, Vine, Instagram, DailyMotion v\xe0 Youku)"}},"zh-CN":{video:{video:"\u89c6\u9891",videoLink:"\u89c6\u9891\u94fe\u63a5",insert:"\u63d2\u5165\u89c6\u9891",url:"\u89c6\u9891\u5730\u5740",providers:"(\u4f18\u9177, Instagram, DailyMotion, Youtube\u7b49)"}},"zh-TW":{video:{video:"\u5f71\u7247",videoLink:"\u5f71\u7247\u9023\u7d50",insert:"\u63d2\u5165\u5f71\u7247",url:"\u5f71\u7247\u7db2\u5740",providers:"(\u512a\u9177, Instagram, DailyMotion, Youtube\u7b49)"}}}})});