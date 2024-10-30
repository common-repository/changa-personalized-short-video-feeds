/*
	PRIORITY
		1) inPage shortCode
		2) [#]tagName
		3) after 1st para.
*/

(function (){
	if(jQuery || $){
		window.$ = jQuery || $;
		// if shortcode exists return ;
		if($('div[appid]')[0]) return;


		let generic = $('#changa_generic');
		// console.log(generic);
		const  appid = generic[0] && generic[0].getAttribute('data_appid');
		if(!appid || appid == '__false__' ) return;
		const  para = parseInt(generic[0].getAttribute('data_para'));

		let paras = $('p');

		paras = paras.filter((p)=>{
			return ($(paras[p])[0].innerText.length > 200);
		})

		let content = `<div ag = 'true' id='changa-slider' appid='${appid}' slider-type='vertical'></div>`

		if(!paras.length){
			let footer = $('footer');
			if(footer.length){
				$(footer[0]).after(content);
			}
			
			return;
		}

		let fPara = Math.max(para,1);
		fPara = Math.min(fPara, paras.length);

			let eC = $('.entry-content')[0];
			// let paras = $(eC).children();
			fPara = Math.min(fPara, paras.length);


			$(paras[fPara-1]).after(content);

	}else{
		console.log('wp_chnga_script  JQUERY NOT DEFINED ');
	}
})();