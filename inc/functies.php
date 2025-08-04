<?php
function youtubeEmbedUrl($url) {
    $parts = parse_url($url);
    if (!isset($parts['query'])) {
        return false;
    }
    parse_str($parts['query'], $query);

    if (!isset($query['v'])) {
        return false;
    }

    $video_id = $query['v'];

    $start = 0;
    if (isset($query['t'])) {
        $time = $query['t'];
        preg_match_all('/(\d+)([hms])/', $time, $matches, PREG_SET_ORDER);
        $start_seconds = 0;
        foreach ($matches as $match) {
            $num = intval($match[1]);
            $unit = $match[2];
            if ($unit === 'h') $start_seconds += $num * 3600;
            if ($unit === 'm') $start_seconds += $num * 60;
            if ($unit === 's') $start_seconds += $num;
        }
        $start = $start_seconds;
    }

    $embed_url = "https://www.youtube.com/embed/" . $video_id;
    if ($start > 0) {
        $embed_url .= "?start=" . $start;
    }

    return $embed_url;
}