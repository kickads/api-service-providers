const $buttons  = document.querySelectorAll('.btnTooltip');
const $tooltips = document.querySelectorAll('.tooltip');

console.log($tooltips);

$buttons.forEach((btn, i) => {
	btn.addEventListener('click', e => {
		const url = e.currentTarget.getAttribute('data-url');
		navigator.clipboard.writeText(url);
		
		$tooltips[i].classList.add('fade-in-up');
		
		setTimeout(() => {
			$tooltips[i].classList.remove('fade-in-up');
		}, 1000);
	});
});


