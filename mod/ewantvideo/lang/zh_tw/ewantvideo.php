<?php

/**
 * Strings for component 'ewantvideo', language 'zh_tw', branch 'MOODLE_27_STABLE'
 *
 * @package   ewantvideo
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['captions'] = '字幕(說明，標題)';
$string['captions_help'] = '以webVTT格式將對話的文字稿加在此處。你可以加入多個檔案，以便呈現多語言的字幕。檔名，如無延伸檔名，則使用者即可在影像之多種字幕中挑選。如果檔名依ISO6392命名(例如eng.vtt及swe.vtt)這種字幕將依使用者之偏好，以相對應的語言全名顯現出來(例如eng.vtt及zho.vtt即為英語與中文-以中文語言包呈現)';
$string['err_positive'] = '在此必須輸入大於零的數字';
$string['filearea_captions'] = '字幕';
$string['filearea_posters'] = '張貼者';
$string['filearea_videos'] = '影片檔';
$string['height'] = '高度';
$string['height_explain'] = '指定影像播放器的預設高度。';
$string['height_help'] = '在這裡輸入影像的高度(例如：畫素500就輸入高500)';
$string['modulename'] = '影音教材';
$string['modulenameplural'] = '影音檔案';
$string['pluginadministration'] = '影音檔案管理';
$string['pluginname'] = '影音教材';
$string['posters_help'] = '於此加入圖像，當影像開始播放時即顯示出此圖像。';
$string['responsive'] = '自動調整影像?';
$string['responsive_explain'] = '指定是否自動調整影像，或者將自動調整這項功能指定為預設值。';
$string['responsive_help'] = '於此打勾，可令影像自動隨著瀏覽器的視窗尺寸變動。且使用其長寛來定義影像的比例(如16/9或
800/450)';
$string['video_fieldset'] = '影像檔';
$string['ewantvideo:addinstance'] = '加入新的影片教材';
$string['ewantvideo_defaults_heading'] = '影片教材的預設值';
$string['ewantvideo_defaults_text'] = '你在此設定的數值即為預設值，未來你製作的影像檔將依此數值出現。';
$string['ewantvideo:view'] = '檢視影音檔案';
$string['video_not_playing'] = '影像不能播? 試著點擊{$a}直接下載影片檔';
$string['videos'] = '影片檔';
$string['videos_help'] = '於此加入影像檔。你可以增加不同影像檔格式，以便那些影像檔在不同的瀏覽器都能播放。(通常像mp4, ogv , webm),影音檔案的編碼如下:<br/>
.mp4 = H.264 + AAC<br/>
.ogg/.ogv = Theora + Vorbis<br/>
.webm = VP8 + Vorbis<br/>
請注意上傳的檔案是否有符合這些格式之一';
$string['width'] = '寛度';
$string['posters'] = '影片開頭圖片';
$string['width_explain'] = '指定影像播放器的預設值';
$string['width_help'] = '在這裡輸入影像的寛度(例如：畫素800就輸入高800)';
$string['trackview'] = '是否啟用瀏覽時數追蹤?';
$string['trackview_explain'] = '是否在新增資源時預設勾選啟用瀏覽時數追蹤。';
$string['trackview_help'] = "在使用者瀏覽影片時啟用瀏覽時數追蹤。";
$string['trackview_label'] = '';

$string['videotype'] = '影片類型';
$string['youtube'] = 'Youtube網址';
$string['youku'] = 'YouKu代碼';
$string['taiwanurl'] = '台灣網址';
$string['chinaurl'] = '大陸網址';
$string['streaming'] = '串流播放網址';
$string['twstreaming'] = '串流網址';
$string['cnstreaming'] = '串流網址';

$string['err_required'] = 'You must supply a video.';