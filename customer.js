// Adapted from Damian Jankov's response found at: https://stackoverflow.com/questions/24750623/select-a-row-from-html-table-and-send-values-onclick-of-a-button/61338981#61338981
var SelectedRow = "";

function highlight(row) {
    SelectedRow=row.cells[0].textContent;
    deHighlight();
    row.style.backgroundColor = '#003F87';
	row.style.color = 'white';
    row.classList.toggle("selectedRow");
}

function deHighlight() { 
    let table = document.getElementById("customerTable");
    let rows = table.rows;
    for (let i = 0; i < rows.length; i++) {
        rows[i].style.backgroundColor = "transparent";
		rows[i].style.color = 'black';
    }   
}

function getSelectedRow() {
    return(SelectedRow);
}

// End of Damian Jankov

function searchForCustomer(customerID, customerPhone) {
	newSearch = "";
	added = false; // Needed for commas between search criterea
	if (customerID == "") {
		customerID = null; // Makes null rather than empty
	} else {
		addString = "customerID=" + customerID; // words to add to query for search
		newSearch = newSearch.concat(addString);  // Add the string to the query
		added = true; // Mark we added something for future commas as needed
	}
	
	if (customerPhone == "") { // Everything same as above, just swapped out variables
		customerPhone = null;
	} else {
		addString = "customerPhone=" + '"' + customerPhone + '"';
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
	}
	
	if (customerPhone == null && customerID == null) {
		alert("Please enter an ID or a phone number");
	} else {
		// alert("Searching with Query: " + newSearch);
		window.location = "customer.php?query=true&" + newSearch;
	}
}

function generateCustomerID() {
	newID = Math.floor(Math.random() * (29999999 - 20000000 + 1)) + 20000000;
	window.location = 'addCustomer.php?id=' + newID;
}

function searchCustomer() {
		window.location = 'searchCustomer.php';
}

function deleteCustomer() {
	if (getSelectedRow() == "") {
		alert("Please select a customer to delete")
	} else {
		if (confirm('Are you sure you wish to delete customer ID ' + getSelectedRow()) == true) {
			window.location = 'customer.php?delete=true&id=' + getSelectedRow();
		} else {
			alert("CANCELED");
		}
	}
}

function back() {
	window.location = 'index.php';
}

function addCustomer() {
	if (confirm('Are you sure you wish to add a new customer?') == true) {
		window.location = 'addCustomer.php';
	} else {
		alert("CANCELED");
	}
}

function addNewCustomer(customerID, customerFirstName, customerLastName, customerPhone, customerAddress, customerAddress2, customerCity, customerState, customerZipcode) {
	if (confirm('Are you sure you want to commit changes?') == true) {
			if(customerID != "" && customerFirstName != "" && customerLastName != "" && customerPhone != "" && customerAddress != "" && customerCity != "" && customerState != "" && customerZipcode != "") {
				window.location = 'addingCustomer.php?id=' + customerID + '&customerFirstName=' + customerFirstName + '&customerLastName=' + customerLastName +'&customerPhone=' + customerPhone +'&customerAddress=' + customerAddress + '&customerAddress2=' + customerAddress2 + '&customerCity=' + customerCity + '&customerState=' + customerState + '&customerZipcode=' + customerZipcode;
			} else {
				alert("Please fill out all required fields")
			}
		} else {
			alert("CANCELED")
		}
}

function modifyCustomer() {
		window.location = 'modifyCustomer.php?id=' + getSelectedRow();
}

function modifyCustomerInfo(customerID, customerFirstName, customerLastName, customerPhone, customerAddress, customerAddress2, customerCity, customerState, customerZipcode) {
	if (confirm('Are you sure you want to commit changes?') == true) {
			if(customerID != "" && customerFirstName != "" && customerLastName != "" && customerPhone != "" && customerAddress != "" && customerCity != "" && customerState != "" && customerZipcode != "") {
				window.location = 'changingCustomer.php?id=' + customerID + '&customerFirstName=' + customerFirstName + '&customerLastName=' + customerLastName +'&customerPhone=' + customerPhone +'&customerAddress=' + customerAddress + '&customerAddress2=' + customerAddress2 + '&customerCity=' + customerCity + '&customerState=' + customerState + '&customerZipcode=' + customerZipcode;
			} else {
				alert("Please fill out all required fields")
			}
		} else {
			alert("CANCELED")
		}
}