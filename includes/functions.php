<?php
namespace cookingrush_net_comment_emoji;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class cookingrush_matisweb_jafar_comment_emoji{
    
    public $css,$emoji;
    
    function __construct( $mycssname, $emoji ){
        $this->css = $mycssname;
        $this->emoji = $emoji;    
    }

    //private $list = "🍭 🍫 🍟 🥓 🍍 🥙 🍯 🥐 🍬 🥟 🥦 🍙 🍣 🥩 🥗 🍩 🍊 🍨 🥔 🍛 🍌 🍮 🌽 🍧 🍓 🥜 🌯 🍚 🍐 🥨 🍒 🍢";
    private $list = "🍭 🍟 🥙 🍯 🥐 🥟 🥦 🍣 🥩 🥗 🍩 🍨 🥔 🍛 🍮 🍧 🥜 🌯 🍚 🥨";

    private function cookingrush_make_emoji_link( &$item, $key ){
        $item = "<a href=''>{$item}</a>";
    }

    function cookingrush_emojilist(){
        $list1 = explode(" ",$this->list);
        array_walk($list1, [$this,'cookingrush_make_emoji_link'] );

        $list = "<span class='{$this->css}'>
            <span class='list{$this->css}'>". implode( "", $list1 ) ."</span>";
        return $list;
    }

    function cookingrush_btn(){
        $btn = "<span class='s{$this->css}'>$this->emoji</span>";
        return $btn;
    }


    function cookingrush_js(){
        $js = "document.addEventListener('DOMContentLoaded', () => {
            var cooking_comment_main = document.querySelector('.{$this->css}');
            var cooking_comment_hand = cooking_comment_main.querySelector('span.s{$this->css}');
            var cooking_comment_box = cooking_comment_main.querySelector('span.list{$this->css}');
            var cooking_comment_textArea = cooking_comment_main.querySelector('textarea');
            function open_cooking_comment_box(){       
                //console.log( 'open', cooking_comment_hand.style.display );      
                if( cooking_comment_hand.style.display=='' ){
                    cooking_comment_hand.style.display = 'none';
                    cooking_comment_box.style.display = 'flex';
                    check_if_click_outside();
                }
            }
            function close_cooking_comment_box(){
                //console.log( 'close', cooking_comment_box.style.display );      
                if( cooking_comment_box.style.display=='flex' ){
                    cooking_comment_box.style.display = 'none';
                    cooking_comment_hand.style.display = '';
                    document.removeEventListener('mouseup', clickedOutofEmojiList );
                }
            }
            cooking_comment_hand.addEventListener('click',function(){
                open_cooking_comment_box();
                return false;
            });
            function check_if_click_outside(){
                document.addEventListener('mouseup', clickedOutofEmojiList );
            }
            function clickedOutofEmojiList(e){
                if ( cooking_comment_box.contains(e.target)==false ){
                    close_cooking_comment_box();
                }
            }
            var emojiList = cooking_comment_box.querySelectorAll('a');
            for (let i = 0; i < emojiList.length; i++) {
                emojiList[i].addEventListener('click', function(evt) {
                    twEmo = this.querySelector('img');
                    addit = ( twEmo !== null ) ? twEmo.alt : this.text;
                    //console.log( 'emoji', addit );
                    if( addit.length>0 ){
                        pos = cooking_comment_textArea.selectionStart;
                        tex = cooking_comment_textArea.value;
                        tex = tex.slice(0,pos) + addit + tex.slice(pos);
                        cooking_comment_textArea.value = tex;
                        cooking_comment_textArea.focus();
                        pos += addit.length;
                        cooking_comment_textArea.setSelectionRange(pos, pos);
                        close_cooking_comment_box();
                    }
                    evt.preventDefault();
                    return false;
                });
            }
        });";
        return $js;
    }

    function cookingrush_css(){
        $IconMainPosition = ( is_rtl() ) ? 'left' : 'right';
        $css = ".{$this->css}{position:relative;display:inline-block;}
        .{$this->css} span.s{$this->css} {position:absolute;top:5px;{$IconMainPosition}:5px;
            width:2em;height:2em;line-height:2em;text-align:center;
            background-color:rgba(255,255,255,.8);border:1px solid rgba(0,0,0,.2);border-radius:.5em;
            box-shadow:0 5px 20px -10px rgba(0,0,0,0.5);
            cursor:pointer;user-select:none;transition:all 300ms;}
        .{$this->css} span.s{$this->css}:hover {
            background-color:rgba(40, 130, 255,.2);border:1px solid rgba(40, 130, 255,.3);
            box-shadow:none;transition:all 300ms;
        }
        .{$this->css} span.list{$this->css} {display:none;position:absolute;top:5px;{$IconMainPosition}:5px;flex-wrap:wrap;justify-content:space-between;width:200px;max-width:95%;
            background-color:rgba(255,255,255,.8);border:1px solid rgba(0,0,0,.1);border-radius:.5em;
            box-shadow:0 5px 20px -10px rgba(0,0,0,0.5);
        }
        .{$this->css} span.list{$this->css} a {display:inline-block;
            width:2em;height:2em;line-height:2em;text-align:center;
            background-color:rgba(255,255,255,.5);border:1px solid rgba(0,0,0,0);border-radius:.5em;text-decoration:none;outline:none;}
        .{$this->css} span.list{$this->css} a:hover {
            background-color:rgba(40, 130, 255,.2);border:1px solid rgba(40, 130, 255,.03);
            box-shadow:0 5px 20px -10px rgba(0,0,0,0.5);
        }";
        return $css;
    }

}