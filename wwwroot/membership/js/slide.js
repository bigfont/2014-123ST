sliderImages = []
sliderOptions = []
sliderOptionsDeafults = {
	mode: 'standard', //peopleRegistry, thumbnails
	listID: null, 
	galleryListID: null
}
sliderConfig = {}
sliderConfigDeafults = {
	speed: 6000, 
	animatonDuration: 1250,
	delayNextSlider: 3000
}
general={
	animationTime: 250
}

$(function() {
	
		
	/*** @author Alexander Farkas v. 1.22 */
	(function($) { if(!document.defaultView || !document.defaultView.getComputedStyle){ var oldCurCSS = $.curCSS; $.curCSS = function(elem, name, force){ if(name === 'background-position'){ name = 'backgroundPosition'; } if(name !== 'backgroundPosition' || !elem.currentStyle || elem.currentStyle[ name ]){ return oldCurCSS.apply(this, arguments); } var style = elem.style; if ( !force && style && style[ name ] ){ return style[ name ]; } return oldCurCSS(elem, 'backgroundPositionX', force) +' '+ oldCurCSS(elem, 'backgroundPositionY', force); }; } var oldAnim = $.fn.animate; $.fn.animate = function(prop){ if('background-position' in prop){ prop.backgroundPosition = prop['background-position']; delete prop['background-position']; } if('backgroundPosition' in prop){ prop.backgroundPosition = '('+ prop.backgroundPosition; } return oldAnim.apply(this, arguments); }; function toArray(strg){ strg = strg.replace(/left|top/g,'0px'); strg = strg.replace(/right|bottom/g,'100%'); strg = strg.replace(/([0-9\.]+)(\s|\)|$)/g,"$1px$2"); var res = strg.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/); return [parseFloat(res[1],10),res[2],parseFloat(res[3],10),res[4]]; } $.fx.step. backgroundPosition = function(fx) { if (!fx.bgPosReady) { var start = $.curCSS(fx.elem,'backgroundPosition'); if(!start){ start = '0px 0px'; } start = toArray(start); fx.start = [start[0],start[2]]; var end = toArray(fx.end); fx.end = [end[0],end[2]]; fx.unit = [end[1],end[3]]; fx.bgPosReady = true; } var nowPosX = []; nowPosX[0] = ((fx.end[0] - fx.start[0]) * fx.pos) + fx.start[0] + fx.unit[0]; nowPosX[1] = ((fx.end[1] - fx.start[1]) * fx.pos) + fx.start[1] + fx.unit[1]; fx.elem.style.backgroundPosition = nowPosX[0]+' '+nowPosX[1]; }; })(jQuery);
	/* end background animation plugin */
	
	tr = function(s) {
		try { console.log(s) } catch (e) { alert(s) }
	}
	
	trimMe = function(a, b){
		if(b==1) return a.replace(/^\s+/,'').replace(/\s+$/,'')
		else return encodeURI(a.replace(/^\s+/,'').replace(/\s+$/,'').replace(/\s/g, '-').toLowerCase())
	}
	
	hashURL = function(hash){
		if(hash!=null){
			window.location.href = window.location.href.replace(/#.*$/, '')+'#'+hash
			return true
		}
		else{
			hash = window.location.href.match(/\#(.*)$/)
			return hash==null ? null : hash[1]
		}
	}
	
	
if($('.sliderwrapper').length){
		for(var k in sliderConfigDeafults){
			if(sliderConfig[k] == undefined) sliderConfig[k] = sliderConfigDeafults[k]
		}
	
		makeImagesList = function(theS){
			sliderImages[theS] = []
			S = $('#'+theS)
			list = $('#'+sliderOptions[theS].listID)
			if(sliderOptions[theS].mode='peopleRegistry'){
				list.find('li').each(function(){
					ind = list.find('li').index(this)
					$(this).attr('id', 'list'+ind)
					sliderImages[theS][ind] = {
						image: $(this).find('a.image').attr('href'),
						link: $(this).find('a.link').attr('href'),
						thumb: $(this).find('a.image img') ? $(this).find('a.image img').attr('src') : null,
						name: $(this).find('.name') ? $(this).find('.name').html() : null,
						captionStyle: $(this).find('.name') && $(this).find('.name').attr('style') ? $(this).find('.name').attr('style') : null,
						email: $(this).find('a.name') ? $(this).find('a.name').attr('href') : null,
						info: $(this).find('.info') ? $(this).find('.info').html() : null
					}
				})
			}
			else{
				list.find('li').each(function(){
					ind = list.find('li').index(this)
					$(this).attr('id', 'list'+ind)
					sliderImages[theS][ind] = {
						image: $(this).find('a.image').attr('href'),
						thumb: $(this).find('a.image img').length ? $(this).find('a.image img').attr('src') : null,
						title: $(this).find('.title').length ? $(this).find('title').html() : null,
						author: $(this).find('.author').length ? $(this).find('author').html() : null
					}
				})
			}
		}
		
		function numSlide(theS, num){
			S = $('#'+theS)
			last = parseInt(sliderImages[S.attr('id')].length-1)
			if(num>last) return num-last-1
			else if(num<0) return 1+last+num
			else return parseInt(num)
		}
		
		photoLoaded = function(t){
			$(t).find('img').addClass('loaded')
		}
		
		function addSlide(theS, num, cls){
			S = $('#'+theS)
			num = numSlide(theS, num)
			if(S.find('#img'+num).length==0){
				S.prepend(
					'<div class="main-image'+(cls!=undefined ? ' '+cls : '')+'" id="img'+num+'">'
						+(sliderImages[theS][num].link ? '<a href="'+sliderImages[theS][num].link+'">' : '')
						+'<img alt="'+sliderImages[theS][num].title+'" onload="photoLoaded(\'#img'+num+'\');"/>'
						+(sliderImages[theS][num].link ? '</a>' : '')
						+(0 && (sliderOptions[theS].mode=='standard' || sliderOptions[theS].mode=='thumbnails') ? ''
							+'<div class="photo-descr">'
								+(sliderOptions[theS].mode=='thumbnails' ? '<span class="counter">'+(num+1)+'/'+sliderImages[theS].length+'</span>' : '')
								+'<span class="title">'+sliderImages[theS][num].title+'</span>'
								+'<span class="author">'+sliderImages[theS][num].author+'</span>'
							+'</div>' : ''
						)
						+(sliderOptions[theS].mode=='peopleRegistry' && sliderImages[theS][num].captionStyle ? ''
							+'<div class="photo-caption" style="'+sliderImages[theS][num].captionStyle+'">'
								+(sliderImages[theS][num].email ? '<a href="'+sliderImages[theS][num].email+'">' : '')
								+(sliderImages[theS][num].name ? '<span class="name">'+sliderImages[theS][num].name+'</span>' : '')
								+(sliderImages[theS][num].email ? '</a>' : '')
								+(sliderImages[theS][num].info ? '<div class="info">'+sliderImages[theS][num].info+'</div>' : '')
							+'</div>' : ''
						)
					+'</div>'
				)
				if(sliderOptions[theS].animation=='vertical'){
					S.find('.photo-descr > div').append('<div class="photo-label'+(typeof(Scls)!='undefined' ? ' '+cls : '')+'" id="label-'+num+'">'+sliderImages[theS][num].title+'</div>')
				}
				S.find('#img'+num+' img').load(function(e){
					$(this).addClass('loaded')
				}).attr('src', sliderImages[theS][num].image)
			}
		}
		
		checkQueue = function(theS){
			//trace('checkQueue: '+theS+', animated='+sliderOptions[theS].animated)
			S = $('#'+theS)
			if(sliderOptions[theS].animated==0 && sliderOptions[theS].queue && sliderOptions[theS].queue.length>0){
			//if(S.children('.main-image:animated').length==0 && sliderOptions[theS].queue && sliderOptions[theS].queue.length>0){
				changeSlide(theS, sliderOptions[theS].queue.shift())
			}
		}
		
		changeSlide = function(theS, dir, why){
			//trace('changeSlide: '+theS)
			S = $('#'+theS)
			if(sliderOptions[theS].animated>0 && why!='timer'){
			//if(S.children('.main-image:animated').length && why!='timer'){
				if(sliderOptions[theS].queue && sliderOptions[theS].mode!='peopleRegistry') sliderOptions[theS].queue.push(dir)
				else sliderOptions[theS].queue = [dir]
				return false
			}
			else if(sliderOptions[theS].animated>0 || !S.is(':visible')) return false
			theWidth = S.width()
			theHeight = S.height()
			current = parseInt(S.children('.current').attr('id').substring(3))
			last = sliderImages[theS].length-1
			direction = '-'
			if(dir=='next') nextSlide = numSlide(theS, current+1)
			else if(dir=='prev'){
				nextSlide = numSlide(theS, current-1)
				if(current==nextSlide) return false
				$('#img'+nextSlide).css('left', -theWidth)
				direction = '+'
			}
			else if(parseInt(dir)<current){
				nextSlide = numSlide(theS, dir)
				if(current==nextSlide) return false
				$('#img'+nextSlide).css('left', -theWidth)
				direction = '+'
			}
			else nextSlide = numSlide(theS, dir)
			if(current==nextSlide) return false
			//trace(dir)
			addSlide(theS, nextSlide)
			if(sliderOptions[theS].mode=='peopleRegistry' && $('#img'+nextSlide).find('img.loaded').length==0 ){
				sliderOptions[theS].queue = []
				clearInterval(sliderOptions[theS].preload)
				sliderOptions[theS].preload = setTimeout("changeSlide('"+theS+"', '"+dir+"', 'preloader')", 50)
				return false
			}
			else clearInterval(sliderOptions[theS].preload)
			
			sliderOptions[theS].animated +=2
			addSlide(theS, nextSlide+1)
			addSlide(theS, nextSlide-1)
			//trace('changeSlide animate from: '+S.children('.current').attr('id')+'@'+S.children('.current').css('left')+', '+S.children('#img'+nextSlide).attr('id')+'@'+S.children('#img'+nextSlide).css('left'))
			if(sliderOptions[theS].animation!='vertical'){
				S.children('#img'+nextSlide).css('left', (direction=='-' ? '' : '-')+theWidth+'px').css('width', '100%')
				S.children('.current, #img'+nextSlide).animate({left: direction+'='+theWidth}, sliderConfig.animatonDuration, 'swing', function(){
					theS = $(this).parents('.sliderwrapper').attr('id')
					if($(this).hasClass('current')){
						//trace('callback: '+theS+' called by: '+$(this).attr('id'))
						sliderOptions[theS].animated -=1
						$(this).removeClass('current').css('left', '')
						checkQueue(theS)
						//setTimeout("checkQueue('"+theS+"')", 1)
					}
					else{
						//trace('callback: '+theS+' called by: '+$(this).attr('id'))
						sliderOptions[theS].animated -=1
						$(this).addClass('current').css('left', '')
						checkQueue(theS)
						//setTimeout("checkQueue('"+theS+"')", 1)
					}
				})
				newNaviWidth = Math.max(0, S.width()-S.find('#img'+nextSlide+' img').width())/2+150
				//S.find('#slider-navi a.prev').css('backgroundPosition', '150px 50%')
				S.find('#slider-navi a.next').animate({
					width: newNaviWidth,
					backgroundPosition: Math.min((150-34/2), (newNaviWidth-34))+'px 50%'
				} , sliderConfig.animatonDuration, 'swing')
				S.find('#slider-navi a.prev').animate({
					width: newNaviWidth,
					backgroundPosition: Math.max((newNaviWidth-150-34/2), 0)+'px 50%'
				} , sliderConfig.animatonDuration, 'swing')
			}
			else{
				//S.children('.current').css('zIndex', 10)
				S.children('#img'+nextSlide).css('left', 0).css('zIndex', 5).animate({top: 0}, sliderConfig.animatonDuration, 'swing', function(){
					theS = $(this).parents('.sliderwrapper').attr('id')
					//trace('callback: '+theS+' called by: '+$(this).attr('id'))
					sliderOptions[theS].animated -=1
					$(this).addClass('current').css('top', '').css('zIndex', '')
					checkQueue(theS)
					//setTimeout("checkQueue('"+theS+"')", 1)
				})
				S.children('.current').animate({top: direction+'='+theHeight}, sliderConfig.animatonDuration, 'swing', function(){
					theS = $(this).parents('.sliderwrapper').attr('id')
					//trace('callback: '+theS+' called by: '+$(this).attr('id'))
					sliderOptions[theS].animated -=1
					$(this).removeClass('current').css('top', '').css('zIndex', '')
					checkQueue(theS)
					//setTimeout("checkQueue('"+theS+"')", 1)
				})
				if(direction == '-'){
					lz = S.find('#label-'+numSlide(theS, nextSlide-2))
					la = S.find('#label-'+numSlide(theS, nextSlide-1))
					lb = S.find('#label-'+nextSlide)
					lc = S.find('#label-'+numSlide(theS, nextSlide+1))
					/*if(!parseInt(lb.attr('rel'))>0) lb.attr('rel', lb.width())
					lz.animate({left: -lz.width()}, 500, function(){$(this).css('left', 940)})
					la.animate({left: 80, fontSize: 12 }, 500)
					lb.animate({left: 940/2-lb.width()/3, fontSize: 17 }, 350, 'linear', function(){
						$(this).animate({left: 940/2-$(this).width()/2 }, 150, 'linear')
					})
					lc.animate({left: 940}, 1)
					lc.animate({left: 940-80-lc.width() }, 500)*/
					lz.fadeTo(sliderConfig.animatonDuration/3, 0, function(){
						$(this).css('left', 940)
					})
					la.fadeTo(sliderConfig.animatonDuration/3, 0, function(){
						$(this).css({left: 80, fontSize: 12 }).fadeTo(sliderConfig.animatonDuration*2/3, 1)
					})
					lb.fadeTo(sliderConfig.animatonDuration/3, 0, function(){
						$(this).css({fontSize: 17 }).css({left: 940/2-$(this).width()/2 }).fadeTo(sliderConfig.animatonDuration*2/3, 1)
					})
					lc.fadeTo(sliderConfig.animatonDuration/3, 0, function(){
						$(this).css({left: 940-80-$(this).width() }).fadeTo(sliderConfig.animatonDuration*2/3, 1)
					})
				}
				else{
					la = S.find('#label-'+numSlide(theS, nextSlide-1))
					lb = S.find('#label-'+nextSlide)
					lc = S.find('#label-'+numSlide(theS, nextSlide+1))
					ld = S.find('#label-'+numSlide(theS, nextSlide+2))
					/*if(!parseInt(lb.attr('rel'))>0) lb.attr('rel', lb.width())
					la.animate({left: -la.width()}, 1)
					la.animate({left: 80 }, 500).addClass('prev')
					lb.animate({left: 940/2-lb.width(), fontSize: 17 }, 350, 'linear', function(){
						$(this).animate({left: 940/2-$(this).width()/2 }, 150, 'linear')
					})
					lc.animate({left: 940-80-parseInt(lc.attr('rel')), fontSize: 12 }, 500)
					ld.animate({left: 940}, 500)*/
					la.fadeTo(sliderConfig.animatonDuration/3, 0, function(){
						$(this).css({left: 80 }).fadeTo(sliderConfig.animatonDuration*2/3, 1)
					})
					lb.fadeTo(sliderConfig.animatonDuration/3, 0, function(){
						$(this).css({fontSize: 17 }).css({left: 940/2-$(this).width()/2}).fadeTo(sliderConfig.animatonDuration*2/3, 1)
					})
					lc.fadeTo(sliderConfig.animatonDuration/3, 0, function(){
						$(this).css({fontSize: 12 }).css({left: 940-80-$(this).width()}).fadeTo(sliderConfig.animatonDuration*2/3, 1)
					})
					ld.fadeTo(sliderConfig.animatonDuration/3, 0, function(){
						$(this).css('left', 940)
					})
				}
			}
			
			if(sliderOptions[theS].mode=='standard'){
				S.find('#slider-pager > .current').removeClass('current')
				S.find('#slider-pager > a:nth('+nextSlide+')').addClass('current')
			}
			else if(sliderOptions[theS].mode=='thumbnails'){
				$('#thumb-carousel .current').removeClass('current')
				$('#thumb-carousel a:nth('+nextSlide+')').addClass('current')
				$('#img'+nextSlide+' .photo-descr .counter').text((nextSlide+1)+'/'+(last+1))
			}
			
			if (sliderOptions[theS].listID != null){
				$('#'+sliderOptions[theS].listID+' .current').removeClass('current')
				$('#'+sliderOptions[theS].listID+' li#list'+nextSlide).addClass('current')
			}
			
		}
		
		restartSlider = function(theS){
			$('#'+theS).children('.main-image').stop(true, false).remove()
			$('#thumb-carousel').add('#slider-navi').add('#carousel-navi').remove()
			clearInterval(sliderOptions[theS].timer)
			sliderOptions[theS].queue = []
			sliderImages[theS] = sliderImages[$(this).parent().attr('id')]
			startSlider(theS, true)
		}
		
		startCarousel = function(){
			$('#thumb-carousel').addClass('paginated').wrapInner('<div id="thumb-carousel-wrapper"></div>').after('<div id="carousel-navi"><a href="#" class="prev"></a><a href="#" class="next"></a></div>')
			$('#carousel-navi a.prev').hide()
			$('#carousel-navi a').click(function(e){
				e.preventDefault()
				if($('#thumb-carousel-wrapper:animated').length) return false;
				if($(this).hasClass('next')) sign = '-'
				else sign = '+'
				$('#thumb-carousel-wrapper').animate({marginLeft: sign+'='+$('#thumb-carousel').width()}, sliderConfig.animatonDuration, 'swing', function(){
						$('#carousel-navi a').show()
						if($('#thumb-carousel-wrapper').offset().left+$('#thumb-carousel-wrapper').width()<$('#thumb-carousel').offset().left+$('#thumb-carousel').width())
							$('#carousel-navi a.next').hide()
						else if($('#thumb-carousel-wrapper').offset().left>=$('#thumb-carousel').offset().left)
							$('#carousel-navi a.prev').hide()
				})
			})
		}
		
		sliderTimer = []
		startSlider = function(theS, restarted){
			if(restarted==null) restarted==false
			S = $('#'+theS)
			if(sliderOptions[theS] == undefined) sliderOptions[theS] = {}
			for(var k in sliderOptionsDeafults){
				if(sliderOptions[theS][k] == undefined) sliderOptions[theS][k] = sliderOptionsDeafults[k]
			}
			sliderOptions[theS].animated = 0
			if(hashURL()!=null && sliderImages[hashURL().substring(8)] !=undefined ){
				newS = hashURL().substring(8)
				sliderImages[theS] = sliderImages[newS]
				$('#'+sliderOptions[theS].galleryListID+' #'+newS).addClass('current')
				if($('#page-title .default').length==0) $('#page-title').append('<span class="default hidden">'+$('#page-title h1').text()+'</span>')
				$('#page-title h1').text($('#page-title .default').text()+' - '+trimMe($('#'+sliderOptions[theS].galleryListID+' #'+newS).text(), 1))
			}
			else if(sliderOptions[theS].galleryListID != null && sliderImages[theS] == undefined){
				sliderImages[theS] = sliderImages[$('#'+sliderOptions[theS].galleryListID+' .gallery:nth(0)').attr('id')]
				$('#'+sliderOptions[theS].galleryListID+' .gallery:nth(0)').addClass('current')
				if($('#page-title .default').length==0) $('#page-title').append('<span class="default hidden">'+$('#page-title h1').text()+'</span>')
				$('#page-title h1').text($('#page-title .default').text()+' - '+trimMe($('#'+sliderOptions[theS].galleryListID+' .gallery:nth(0)').text(), 1))
			}
			if(sliderOptions[theS].listID != null){
				makeImagesList(theS)
				$('#'+sliderOptions[theS].listID+' li#list0').addClass('current')
				$('#'+sliderOptions[theS].listID+' li').click(function(e){
					e.preventDefault()
					S = $(this).parents('.sliderlist').siblings('.sliderwrapper')
					theS = S.attr('id')
					ind = $(this).attr('id').substring(4)
					clearInterval(sliderOptions[theS].timer)
					sliderOptions[theS].timer = setInterval("changeSlide('"+theS+"', 'next', 'timer')", sliderConfig.speed)
					changeSlide(theS, ind)
				})
				if(sliderOptions[theS].mode=='peopleRegistry'){
					$('body').append($('<img id="peopleRegistryThumb" class="hidden" src="'+sliderImages[theS][0].thumb+'" style="position: absolute; z-index: 100; display: none;" />'))
					$('#'+sliderOptions[theS].listID+' li').hover(
						function(){
							theS = $(this).parents('.sliderlist').siblings('.sliderwrapper').attr('id')
							ind = $(this).attr('id').substring(4)
							if(sliderImages[theS][ind].thumb){
								$('#peopleRegistryThumb').attr('src', sliderImages[theS][ind].thumb).show()
							}
						},
						function(){
							$('#peopleRegistryThumb').hide()
						}
					)
					$('#'+sliderOptions[theS].listID+' li').mousemove(function(e){
						if($('#peopleRegistryThumb').is(':visible')) $('#peopleRegistryThumb').css({'left': e.pageX+20,'top': e.pageY+20})
					})
				}
			}
			ind = $('.sliderwrapper').index(S)
			last = sliderImages[theS].length-1
			if(sliderOptions[theS].mode=='peopleRegistry'){
				S.append($('<div id="slider-navi"><a href="#" class="prev"></a><a href="#" class="next"></a></div>') )
				S.find('#slider-navi .prev').click(function(e){e.preventDefault(); changeSlide($(this).parents('.sliderwrapper').attr('id'), 'prev')})
				S.find('#slider-navi .next').click(function(e){e.preventDefault(); changeSlide($(this).parents('.sliderwrapper').attr('id'), 'next')})
			}
			else if(sliderOptions[theS].mode=='standard'){
				S.append($('<div id="slider-navi"><a href="#" class="prev"></a><a href="#" class="next"></a></div>') )
				S.find('#slider-navi .prev').click(function(e){e.preventDefault(); changeSlide($(this).parents('.sliderwrapper').attr('id'), 'prev')})
				S.find('#slider-navi .next').click(function(e){e.preventDefault(); changeSlide($(this).parents('.sliderwrapper').attr('id'), 'next')})
				S.append($('<div id="slider-pager"></div>') )
				for(var i=0; i<sliderImages[theS].length; i++){
					S.find('#slider-pager').append($('<a href="#"></a>'))
				}
				S.find('#slider-pager a:first-child').addClass('current')
				S.find('#slider-pager a').click(function(e){e.preventDefault(); changeSlide($(this).parents('.sliderwrapper').attr('id'), $('#slider-pager a').index(this))})
			}
			else if(sliderOptions[theS].mode=='thumbnails'){
				if(!restarted){
					$('#'+sliderOptions[theS].galleryListID+' .gallery a').click(function(e){
						e.preventDefault()
						theS = $(this).parents('.gallerylistwrapper').siblings('.sliderwrapper').attr('id')
						$(this).parents('.gallerylistwrapper').find('.current').removeClass('current')
						$(this).parent().addClass('current')
						hashURL('gallery-'+$(this).parent().attr('id'))
						restartSlider(theS)
					})
				}
				S.append($('<a href="#" id="fullscreen"></a>'))
				S.after($('<div id="slider-navi"><a href="#" class="prev"></a><a href="#" class="next"></a></div>') )
				$('#slider-navi .prev').click(function(e){e.preventDefault(); changeSlide($(this).parent().siblings('.sliderwrapper').attr('id'), 'prev')})
				$('#slider-navi .next').click(function(e){e.preventDefault(); changeSlide($(this).parent().siblings('.sliderwrapper').attr('id'), 'next')})
				S.after($('<div id="thumb-carousel"></div>') )
				for(var i=0; i<sliderImages[theS].length; i++){
					$('#thumb-carousel').append($('<a href="#"><img src="'+sliderImages[theS][i].thumb+'" /></a>'))
				}
				$('#thumb-carousel a:first-child').addClass('current')
				$('#thumb-carousel a').click(function(e){
					e.preventDefault(); 
					theS = $(this).parents('#thumb-carousel').siblings('.sliderwrapper').attr('id')
					clearInterval(sliderOptions[theS].timer)
					sliderOptions[theS].timer = setInterval("changeSlide('"+theS+"', 'next', 'timer')", sliderConfig.speed)
					changeSlide(theS, $('#thumb-carousel a').index(this))
				})
				$('#thumb-carousel a').hover(
					function(){
						theS = $(this).parents('#thumb-carousel').siblings('.sliderwrapper').attr('id')
						clearInterval(sliderOptions[theS].timer)
					}, 
					function(){
						theS = $(this).parents('#thumb-carousel').siblings('.sliderwrapper').attr('id')
						clearInterval(sliderOptions[theS].timer)
						sliderOptions[theS].timer = setInterval("changeSlide('"+theS+"', 'next', 'timer')", sliderConfig.speed)
					}
				)
				if(sliderImages[theS].length>12) startCarousel()
			}
			if(S.children('.current').length>0) S.children('.current').attr('id', 'img0')
			else addSlide(theS, 0, 'current')
			addSlide(theS, 1)
			addSlide(theS, last)
			if(sliderOptions[theS].animation!='vertical'){
				S.css({minWidth: 940})
				S.children('.info').insertAfter(S).addClass('container').addClass('slider-info')
				S.find('#img0 img').load(function(){
					newNaviWidth = (S.width()-S.find('.current img').width())/2+150
					//tr(S.find('#slider-navi a').length+' '+newNaviWidth)
					S.find('#slider-navi a.next').css({
						width: newNaviWidth,
						backgroundPosition: Math.min((150-34/2), (newNaviWidth-34))+'px 50%'
					})
					S.find('#slider-navi a.prev').css({
						width: newNaviWidth,
						backgroundPosition: Math.max((newNaviWidth-150-34/2), 0)+'px 50%'
					})
					$(window).resize(function(){
						S = $($('.sliderwrapper')[0])
						if(sliderOptions[S.attr('id')].animated==0)
							nextSlide = parseInt(S.children('.current').attr('id').substring(3))
						else 
							nextSlide = parseInt(S.children('.main-image:animated').not('.current').attr('id').substring(3))
						tr(nextSlide)
						newNaviWidth = Math.max(0, S.width()-S.find('#img'+nextSlide+' img').width())/2+150
						//tr(S.find('#slider-navi a').length+' '+newNaviWidth)
						S.find('#slider-navi a.next').stop(true, false).animate({
							width: newNaviWidth,
							backgroundPosition: Math.min((150-34/2), (newNaviWidth-34))+'px 50%'
						} , 100, 'swing')
						S.find('#slider-navi a.prev').stop(true, false).animate({
							width: newNaviWidth,
							backgroundPosition: Math.max((newNaviWidth-150-34/2), 0)+'px 50%'
						} , 100, 'swing')
						})
				})
			}
			else{
				$('#slider-navi').addClass('hidden').appendTo('#'+theS+' .photo-descr > div')
				la = S.find('#label-'+last)
				lb = S.find('#label-'+0)
				lc = S.find('#label-'+1)
				if(!parseInt(lb.attr('rel'))>0) lb.attr('rel', lb.width())
				la.css({left: 80})
				lb.css({fontSize: 17 }).css({left: 940/2-lb.width()/2})
				lc.css({left: 940-80-lc.width() })
			}
			
			if(ind==0) sliderOptions[theS].timer = setInterval("changeSlide('"+theS+"', 'next', 'timer')", sliderConfig.speed)
			else sliderOptions[theS].timerInitial = setTimeout("changeSlide('"+theS+"', 'next', 'timer'); sliderOptions['"+theS+"'].timer = setInterval(\"changeSlide('"+theS+"', 'next', 'timer')\", sliderConfig.speed)", sliderConfig.delayNextSlider*ind)
		
			S.hover(
				function(){
					clearTimeout(sliderOptions[$(this).attr('id')].timerInitial)
					clearInterval(sliderOptions[$(this).attr('id')].timer)
				}, 
				function(){
					clearInterval(sliderOptions[$(this).attr('id')].timer)
					sliderOptions[$(this).attr('id')].timer = setInterval("changeSlide('"+$(this).attr('id')+"', 'next', 'timer')", sliderConfig.speed)
				})
			if(sliderOptions[theS].animation!='vertical'){
				$('#slider-navi').hover(function(){
					$(this).removeClass('hidden')
				}, 
				function(){
					$('#slider-navi').addClass('hidden')
				})
				$(document).keyup(function(e){
					if(e.keyCode==37 || e.keyCode==39){
						e.preventDefault;
						$('#slider-navi a.'+(e.keyCode==37 ? 'prev' : 'next')).click()
					}
				})
			}
		}
		
		$('.sliderwrapper').each(function(){
			startSlider($(this).attr('id'))
		})
		
	}
});