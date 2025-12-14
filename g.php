<?php
if (!defined('GAL_INCLUDED')) {
define('GAL_INCLUDED', true);
?>
<head>
	<meta charset="UTF-8">
</head>
<style>
	.gal-lightbox {
		display:none;
		position:fixed;
		inset:0;
		background:rgba(0,0,0,.9);
		z-index:9999;
	}
	.gal-lightbox-content {
		display:flex;
		justify-content:center;
		align-items:center;
		width:100%;
		height:100%;
	}

	.gal-inner {
		max-width:90vw;
		max-height:90vh;
	}

	.gal-lightbox img,
	.gal-lightbox video {
		max-width:90vw;
		max-height:90vh;
		object-fit:contain;
	}
	.gal-close {
		user-select: none;
		position:absolute;
		top:20px;
		right:30px;
		font-size:80px;
		color:silver;
		cursor:pointer;
		transition: color 0.2s;
	}

	@media (max-width: 900px), (pointer: coarse) {
		.gal-close {
			font-size: 296px !important;
			line-height: 1 !important;
		}
	}

	.gal-close:hover {
		cursor: pointer;
		position: absolute;
		top: 20px;
		right: 30px;
		font-size: 80px;
		color: #ff5252;
		cursor: pointer;
	}

	.gal-close:active {
		color: black;
	}

	.g {
		position: relative;
		cursor: pointer;
		transition: transform 0.2s;
	}

	.g:hover {
		transform: scale(1.02);
	}

	// PLAY BUTTON
	.g.v-container {
		position: relative !important;
		display: inline-block;
	}

	.g.v-container .play-overlay {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		color: white;
		font-size: 48px;
		text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
		pointer-events: none;
		z-index: 2;
		transition: color 0.2s;
	}

	.g.v-container:hover .play-overlay {
		color: #ff5252;
	}

	.g.v-container:active .play-overlay {
		color: black;
	}
</style>

<div id="gal-lightbox" class="gal-lightbox" onclick="galHide()">
	<span class="gal-close" onclick="galHide(event)">&times;</span>

	<div class="gal-lightbox-content">
		<div class="gal-inner" onclick="event.stopPropagation()">
			<div id="gal-content"></div>
		</div>
	</div>
</div>

<script>
	const lb = document.getElementById('gal-lightbox');
	const content = document.getElementById('gal-content');

	function galShow(src) {
		content.innerHTML = '';

		if (/\.(mp4|webm|mov)$/i.test(src)) {
			const v = document.createElement('video');
			v.src = src;
			v.controls = true;
			v.style.maxWidth = '90vw';
			v.style.maxHeight = '90vh';
			content.appendChild(v);
		} else {
			const img = document.createElement('img');
			img.src = src;
			content.appendChild(img);
		}

		lb.style.display = 'block';
		document.body.style.overflow = 'hidden';
	}

	function galHide(e){
		if(e) e.stopPropagation();
		content.querySelectorAll('video').forEach(v=>{
			v.pause(); v.currentTime=0;
		});
		lb.style.display='none';
		document.body.style.overflow='';
	}

	document.addEventListener('click', e=>{
		const g = e.target.closest('.g');
		if(!g) return;
		e.stopPropagation();
		galShow(g.dataset.src || g.src);
	});

	document.addEventListener('keydown', e=>{
		if(e.key==='Escape') galHide();
	});

	// PLAY BUTTON (Messy JS-Code)
	document.addEventListener('DOMContentLoaded', () => {
		document.querySelectorAll('img.g.v').forEach(img => {
			if (img.parentNode.classList.contains('g') && img.parentNode.classList.contains('v-container')) return;
			
			const extraClasses = img.className.split(' ').filter(c => c !== 'g' && c !== 'v').join(' ');
			
			const wrapper = document.createElement('div');
			wrapper.className = 'g v-container ' + extraClasses;
			
			if (img.hasAttribute('data-src')) {
				wrapper.dataset.src = img.dataset.src;
			}
			wrapper.dataset.originalSrc = img.src;
			
			const overlay = document.createElement('div');
			overlay.className = 'play-overlay';
			overlay.textContent = '▶'; // Place any PLAY-Icon you want. Make sure L. 5-7 contains UTF-8 Charset.
			
			img.parentNode.replaceChild(wrapper, img);
			wrapper.appendChild(img);
			wrapper.appendChild(overlay);
			img.classList.remove('g', 'v');
			
			const rect = img.getBoundingClientRect();
			wrapper.style.width = rect.width + 'px';
			wrapper.style.height = rect.height + 'px';
		});
	});
</script>
<?php } ?>
