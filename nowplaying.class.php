<?php
    class NowPlaying{

        private $url;
        private $noTrackPlayingMessage;

        function __construct($user, $api_key){
            $this->url  = 'http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&limit=1';
            $this->url .= '&user=' . $user . '&api_key=' . $api_key;

            $this->noTrackPlayingMessage = 'nothing is playing right now!';
        }

        public function getNowPlaying(){
            $xml = simplexml_load_file($this->url);
            $track = $xml->recenttracks->track;
            $nowplaying = $track->attributes()->nowplaying;

            if($nowplaying){
                $artist = $track->artist;
                $songname = $track->name;
                if($track->image->attributes()->size == "medium"){
                    $image = $track->image;
                    return $artist . " - " . $songname . "<br /><img src=".$image;
                } else {
                    return $artist . " - " . $songname;
                }
            }
            else{
                return $this->noTrackPlayingMessage;
            }
        }

        public function setNoTrackPlayingMessage($messageIn){
            $this->noTrackPlayingMessage = $messageIn;
        }

    }
?>