<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * fatなコントローラーだけど、かんたんなプログラムなのでそのまま。
 */
class TwitterController extends Controller
{
    public static $hais = [
        '🀀', '🀀', '🀀', '🀀',
        '🀁', '🀁', '🀁', '🀁',
        '🀂', '🀂', '🀂', '🀂',
        '🀃', '🀃', '🀃', '🀃',
        '🀆', '🀆', '🀆', '🀆',
        '🀅', '🀅', '🀅', '🀅',
        '🀄', '🀄', '🀄', '🀄',
        '🀇', '🀇', '🀇', '🀇',
        '🀈', '🀈', '🀈', '🀈',
        '🀉', '🀉', '🀉', '🀉',
        '🀊', '🀊', '🀊', '🀊',
        '🀋', '🀋', '🀋', '🀋',
        '🀌', '🀌', '🀌', '🀌',
        '🀍', '🀍', '🀍', '🀍',
        '🀎', '🀎', '🀎', '🀎',
        '🀏', '🀏', '🀏', '🀏',
        '🀐', '🀐', '🀐', '🀐',
        '🀑', '🀑', '🀑', '🀑',
        '🀒', '🀒', '🀒', '🀒',
        '🀓', '🀓', '🀓', '🀓',
        '🀔', '🀔', '🀔', '🀔',
        '🀕', '🀕', '🀕', '🀕',
        '🀖', '🀖', '🀖', '🀖',
        '🀗', '🀗', '🀗', '🀗',
        '🀘', '🀘', '🀘', '🀘',
        '🀙', '🀙', '🀙', '🀙',
        '🀚', '🀚', '🀚', '🀚',
        '🀛', '🀛', '🀛', '🀛',
        '🀜', '🀜', '🀜', '🀜',
        '🀝', '🀝', '🀝', '🀝',
        '🀞', '🀞', '🀞', '🀞',
        '🀟', '🀟', '🀟', '🀟',
        '🀠', '🀠', '🀠', '🀠',
        '🀡', '🀡', '🀡', '🀡',
    ];

    /**
     * 牌配列から、ランダムに14個抜き出してくれる。
     *
     * @return string $re_sort_hais ランダムな14個配牌（理牌済み）
     */
    public static function getReSortHais()
    {
        $re_sort_hais = '';
        if (shuffle(self::$hais)) {
            $sort_hais = [];
            for ($i = 0; $i < 14; $i++) {
                $sort_hais[] = self::$hais[$i];
            }
            sort($sort_hais);
            foreach ($sort_hais as $key => $value) {
                if ($key % 3 === 0) {
                    $re_sort_hais .= ' ' . $value;
                } else {
                    $re_sort_hais .= $value;
                }
            }
        }
        return $re_sort_hais;
    }

    public function tweet()
    {
        $twitter = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET_KEY'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );

        $twitter->post("statuses/update", [
            "status" =>
            TwitterController::getReSortHais()
        ]);
    }

    public function react()
    {
        $twitter = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET_KEY'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );

        // 'timezone' => 'UTC',
        foreach ($twitter->get("statuses/mentions_timeline", ["count" => "100"]) as $value) {
            $now = strtotime('now');
            $tweetTime = strtotime($value->created_at);
            // 10分以上前の返信には返さない。
            if (($now - $tweetTime) < 600) {
                $getReSortHais = TwitterController::getReSortHais();
                $rp = $twitter->post("statuses/update", ["status" => "@" . $value->user->screen_name . $getReSortHais, "in_reply_to_status_id" => $value->id]);
                $fav = $twitter->post("favorites/create", ["id" => $value->id]);
            }
        }
    }
}
