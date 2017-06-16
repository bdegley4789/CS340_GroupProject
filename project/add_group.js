window.onload = function() {
	var butt1 = document.getElementById('all');
	var butt2 = document.getElementById('full');
	var butt3 = document.getElementById('avail');

	butt1.onclick = function() {
		var x = document.getElementById('Group').tBodies[0];
		var length = x.rows.length;
		for (i = 0; i < length; i++) {
			var row = x.rows[i];
			row.style.display= '';
		}
	};

	butt2.onclick = function() {
		var x = document.getElementById('Group').tBodies[0];
		var length = x.rows.length;
		for (i = 0; i < length; i++) {
			var row = x.rows[i];
			if(parseInt(row.cells[3].innerHTML)-parseInt(row.cells[2].innerHTML) != 0) {
				row.style.display= 'none';
			}
			else {
				row.style.display= '';
			}
		}
	};

	butt3.onclick = function() {
		var x = document.getElementById('Group').tBodies[0];
		var length = x.rows.length;
		for (i = 0; i < length; i++) {
			var row = x.rows[i];
			if(parseInt(row.cells[3].innerHTML)-parseInt(row.cells[2].innerHTML) == 0) {
				row.style.display= 'none';
			}
			else {
				row.style.display= '';
			}
		}
	};
};