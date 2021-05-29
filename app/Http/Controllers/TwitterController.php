<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    public function tweet()
    {
        $twitter = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET_KEY'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SERET')
        );

        $hais = [
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

        if (shuffle($hais)) {
            $sort_hais = [];
            for ($i = 0; $i < 14; $i++) {
                $sort_hais[] = $hais[$i];
            }
            sort($sort_hais);
            $re_sort_hais = '';
            foreach ($sort_hais as $key => $value) {
                if ($key % 3 === 0) {
                    $re_sort_hais .= ' ' . $value;
                } else {
                    $re_sort_hais .= $value;
                }
            }
            $twitter->post("statuses/update", [
                "status" =>
                $re_sort_hais
            ]);
        }
    }
}
