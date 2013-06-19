$(document).ready( 
	function() {

		$('#fbShare').click( 
			function() {
				var sharer = "https://www.facebook.com/sharer/sharer.php?u=";
				//window.open(sharer + location.href, 'sharer', 'width=626,height=436');
				window.open(sharer + location.hostname +"a=" + pass_agentid + "&v=" + pass_vid + "&l=" + pass_level + "&m=facebook", 'sharer', 'width=626,height=436');

				$('#toggle').toggle('fast');
				$(this).css("display","none");
				$('#linkedInShare').css("display","none");
			}
			
			
		);

		$('#linkedInShare').click( 
			function(){

			/*$.getScript("http://platform.linkedin.com/in.js");
			<script src="//platform.linkedin.com/in.js" type="text/javascript">
			 lang: en_US
			</script>
			<script type="IN/Share"></script>*/
			var base="http://www.linkedin.com/shareArticle?mini=true";
			//var currentPageUrl= "&url=" + location.href;
			var currentPageUrl= "&url=" + location.hostname +"/src/index.php?a=" + pass_agentid + "&v=" + pass_vid + "&l=" + pass_level + "&m=facebook";
			var currentPageTitle="&title=" +document.title;
			var summary="&summary=The Real Challenge";
			var source= "&source=The Real Challenge Game";
			window.open(base+currentPageUrl+currentPageTitle+summary+source,'','width=626,height=436');

			$('#toggle').toggle('fast');
			$(this).css("display","none");
			$('#fbShare').css("display","none");

			}
		);



	}
);

