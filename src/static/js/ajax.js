let ajaxBtn = document.getElementById("testAjaxBtn");
let measuresData;

window.onload = function() {
	getMeasuresData();
}
ajaxBtn.onclick = function() {
	getMeasuresData();
}

function getMeasuresData() {

	let ajaxMeasures = document.getElementById("ajaxMeasures");

	let avgTempSlot = document.getElementById("avgTemp");
	let maxTempSlot = document.getElementById("maxTemp");
	let minTempSlot = document.getElementById("minTemp");

	let avgHumSlot = document.getElementById("avgHum");
	let maxHumSlot = document.getElementById("maxHum");
	let minHumSlot = document.getElementById("minHum");

	//regenerate list header
	ajaxMeasures.innerHTML = "";
	let thRow = document.createElement("tr");
	let dateTh = document.createElement("th");
	dateTh.textContent = "Date";
	let tmpTh = document.createElement("th");
	tmpTh.textContent = "Temperature";
	let humTh = document.createElement("th");
	humTh.textContent = "Humidity";

	thRow.appendChild(dateTh);
	thRow.appendChild(tmpTh);
	thRow.appendChild(humTh);

	ajaxMeasures.appendChild(thRow);

	let rangeStartVal = document.getElementById("range_start").value;
	let rangeEndVal = document.getElementById("range_end").value;

	const xhr = new XMLHttpRequest();
	xhr.responseType = "json";

	xhr.onreadystatechange = function(event) {
		if (this.readyState === 4) {
	        if (this.status === 200) {
	        	measuresData = this.response;
						let measures = this.response.measures;
	        	//console.log(measures);
						let measure;
						for (measure in measures) {
							let row = document.createElement("tr");
							let dataTmp = document.createElement("td");
							dataTmp.innerHTML = measures[measure].temperature + "°C";
							let dataHum = document.createElement("td");
							dataHum.innerHTML = measures[measure].humidity + "%";
							let dataDate = document.createElement("td");
							dataDate.innerHTML = measures[measure].date;

							row.appendChild(dataDate);
							row.appendChild(dataTmp);
							row.appendChild(dataHum);

							ajaxMeasures.appendChild(row);
						}
						//stats
						avgTempSlot.textContent = this.response.avgTemp.toFixed(2);
						maxTempSlot.textContent = this.response.maxTemp;
						minTempSlot.textContent = this.response.minTemp;
						avgHumSlot.textContent = this.response.avgHum.toFixed(2);
						maxHumSlot.textContent = this.response.maxHum;
						minHumSlot.textContent = this.response.minHum;

						updateGraph();

	        } else {
	            console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
	        }
	    }
	};

	//xhr.open("GET", "api.php/?c=measures&req=all", true);
	xhr.open("GET", "api.php/?c=measures&req=range&rstart="+rangeStartVal+"&rend="+rangeEndVal, true);
	xhr.send(null);
}
