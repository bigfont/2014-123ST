var membershipDiv;
var specialEventsDiv;
var golfDiv;
var aboutDiv;
var clubhouseDiv;
function hideDiv(div) {
	$(div).style.display = 'none';
}

function toggleLeftMenu() {
	new Effect.toggle('left_menu_sub','blind', {duration: 0.5});
}