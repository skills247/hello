<?php
/**
 * @package CloserSong
 * @version 1.7.2
 */
/*
Plugin Name: CloserSong
Plugin URI: http://wordpress.org/plugins/hello-closer/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, closer. When activated you will randomly see a lyric from <cite>Hello, closer</cite> in the upper right of your admin screen on every page.
Author: User
Version: 1.7.2
Author URI: https://user.com/
*/

function closer_song_get_lyric() {
	/** These are the lyrics to Closer - The Chainsmokers */
	$lyrics = "Hey, I was doing just fine before I met you
	I drink too much and that's an issue but I'm okay
	Hey, you tell your friends it was nice to meet them
	But I hope I never see them again
	I know it breaks your heart
	Moved to the city in a broke down car
	And four years, no calls
	Now you're looking pretty in a hotel bar
	And I can't stop
	No, I can't stop
	So baby pull me closer in the backseat of your Rover
	That I know you can't afford
	Bite that tattoo on your shoulder
	Pull the sheets right off the corner
	Of the mattress that you stole
	From your roommate back in Boulder
	We ain't ever getting older
	We ain't ever getting older
	We ain't ever getting older
	You look as good as the day I met you
	I forget just why I left you, I was insane
	Stay and play that Blink-182 song
	That we beat to death in Tucson, okay
	I know it breaks your heart
	Moved to the city in a broke down car
	And four years, no call
	Now I'm looking pretty in a hotel bar
	And I can't stop
	No, I can't stop
	So baby pull me closer in the backseat of your Rover
	That I know you can't afford
	Bite that tattoo on your shoulder
	Pull the sheets right off the corner
	Of the mattress that you stole
	From your roommate back in Boulder
	We ain't ever getting older
	We ain't ever getting older
	We ain't ever getting older
	So baby pull me closer in the backseat of your Rover
	That I know you can't afford
	Bite that tattoo on your shoulder
	Pull the sheets right off the corner
	Of the mattress that you stole
	From your roommate back in Boulder
	We ain't ever getting older
	We ain't ever getting older (we ain't ever getting older)
	We ain't ever getting older (we ain't ever getting older)
	We ain't ever getting older (we ain't ever getting older)
	We ain't ever getting older
	We ain't ever getting older
	No we ain't ever getting older";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function closer_song() {
	$chosen = closer_song_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="closer"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Hello closer song, by Jerry Herman:' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'closer_song' );

// We need some CSS to position the paragraph.
function closer_css() {
	echo "
	<style type='text/css'>
	#closer {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 16px;
		line-height: 2.6666;
		color: #e25098;
	}
	.rtl #closer {
		float: left;
	}
	.block-editor-page #closer {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#closer,
		.rtl #closer {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'closer_css' );
