<?php
if (!defined('GAL_INCLUDED')) {
define('GAL_INCLUDED', true);
?>
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
.gal-close:hover {
	cursor: pointer
    position: absolute;
	top: 20px;
	right: 30px;
    font-size: 80px;
	color: red;
	cursor: pointer;
}

.gal-close:active {
	color: black;
}

.g {
	cursor: pointer;
	transition: transform 0.2s;
}

.g:hover {
	transform: scale(1.02);
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
</script>
<?php } ?>
