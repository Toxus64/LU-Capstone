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
    let table = document.getElementById("orderTable");
    let rows = table.rows;
    for (let i = 0; i < rows.length ; i++) {
        rows[i].style.backgroundColor = "transparent";
		rows[i].style.color = 'black';
    }   
}

function getSelectedRow() {
    return(SelectedRow);
}

// End of Damian Jankov

function back() {
	window.location = 'index.php';
}

function backOrder(orderID) {
	window.location = 'order.php?query=true&orderID=' + orderID;
}


function searchForOrder(orderID, customerID) {
	newSearch = "";
	added = false; // Needed for commas between search criterea
	if (orderID == "") {
		orderID = null; // Makes null rather than empty
	} else {
		addString = "orderID=" + orderID; // words to add to query for search
		newSearch = newSearch.concat(addString);  // Add the string to the query
		added = true; // Mark we added something for future commas as needed
	}
	
	if (customerID == "") { // Everything same as above, just swapped out variables
		customerID = null;
	} else {
		addString = "orderCustomer=" + '"' + customerID + '"';
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
	}
	
	if (orderID == null && customerID == null) {
		alert("Please enter an order or customer ID");
	} else {
		// alert("Searching with Query: " + newSearch);
		window.location = "order.php?query=true&" + newSearch;
	}
}

function searchOrder() {
		window.location = 'searchOrder.php';
}

function cancelOrder() {
	if (getSelectedRow() == "") {
		alert("Please select an order to cancel")
	} else {
		if (confirm('Are you sure you wish to cancel Order ID ' + getSelectedRow()) == true) {
			window.location = 'order.php?cancel=true&id=' + getSelectedRow();
		} else {
			alert("Did not Cancel Order ID " + getSelectedRow());
		}
	}
}

function modifyOrder() {
	if (getSelectedRow() == "") {
		alert("Please select an order to modify")
	} else {
		if (confirm('Are you sure you wish to modify order ' + getSelectedRow()) == true) {
			window.location = 'modifyOrder.php?id=' + getSelectedRow();
		}
	}
}

function removeFromOrder(orderID) {
	if (getSelectedRow() == "") {
		alert("Please select an item to remove")
	} else {
		if (confirm('Are you sure you wish to modify order ' + orderID) == true) {
			window.location = 'modifyOrder.php?remove=true&id=' + orderID + "&productID=" + getSelectedRow();
		}
	}
}

function createNewOrder() {
	if (confirm('Are you sure you wish to create a new Order?') == true) {
		window.location = 'createOrder.php';
	} else {
		alert("CANCELED");
	}
}

function generateOrderID() {
	newID = Math.floor(Math.random() * (39999999 - 30000000 + 1)) + 30000000;
	window.location = 'createOrder.php?id=' + newID;
}

function getCustomerInfo(orderID, customerID) {
	window.location = 'createOrder.php?id=' + orderID + '&customerID=' + customerID;
}

function addToOrder(orderID, customerID, items, productID) {
	window.location = 'createOrder.php?id=' + orderID + '&customerID=' + customerID + '&items=' + items + '&productID=' + productID;
}

function createOrder(orderID, customerID, items, address, status){
	window.location = 'addingOrder.php?id=' + orderID + '&customerID=' + customerID + '&orderItems=' + items + '&orderAddress=' + address + '&orderStatus=' + status;
}

function getItems(items){
	alert(items);
	var list = '';
	for(var i = 0; i < items.length; i++) {
		if(i >= 1){
			list += " ";
		}
		list += items[i].innerText;
	}
	return list;
}