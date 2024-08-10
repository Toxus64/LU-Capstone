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
    for (let i = 0; i < rows.length; i++) {
        rows[i].style.backgroundColor = "transparent";
		rows[i].style.color = 'black';
    }   
}

function getSelectedRow() {
    return(SelectedRow);
}

// End of Damian Jankov


function deleteItem() {
	if (getSelectedRow() == "") {
		alert("Please select an item to delete")
	} else {
		if (confirm('Are you sure you wish to delete item ' + getSelectedRow()) == true) {
			window.location = 'inventoryRental.php?delete=true&id=' + getSelectedRow();
		} else {
			alert("CANCELED");
		}
	}
}

function modifyItem() {
	if (getSelectedRow() == "") {
		alert("Please select an item to modify")
	} else {
		if (confirm('Are you sure you wish to modify item ' + getSelectedRow()) == true) {
			window.location = 'modifyRentalItem.php?id=' + getSelectedRow();
		} else {
			alert("CANCELED");
		}
	}
}

function backRentalInventory() {
	window.location = 'rentalinventory.php';
}

function changeRentalItem(itemID, itemBrand, itemType, itemSize, itemQuantity) {
	if (confirm('Are you sure you want to commit changes?') == true) {
			if(itemID != "" && itemBrand != "" && itemType != "" && itemSize != "" && itemQuantity != "") {
				window.location = 'changingRentalItem.php?id=' + itemID + '&itemBrand=' + itemBrand + '&itemType=' + itemType +'&itemSize=' + itemSize +'&itemQuantity=' + itemQuantity;
			} else {
				alert("Please fill out all fields")
			}
		} else {
			alert("CANCELED")
		}
}

function addNewRentalItem(itemID, itemBrand, itemType, itemSize, itemQuantity) {
	if (confirm('Are you sure you want to commit changes?') == true) {
			if(itemID != "" && itemBrand != "" && itemType != "" && itemSize != "" && itemQuantity != "") {
				window.location = 'addingRentalItem.php?id=' + itemID + '&itemBrand=' + itemBrand +'&itemType=' + itemType +'&itemSize=' + itemSize + '&itemQuantity=' + itemQuantity;
			} else {
				alert("Please fill out all fields")
			}
		} else {
			alert("CANCELED")
		}
}

function generateitemID() {
	newID = Math.floor(Math.random() * (59999999 - 50000000 + 1)) + 50000000;
	window.location = 'addRentalItem.php?id=' + newID;
}

function addItem() {
	if (confirm('Are you sure you wish to add a new item?') == true) {
		window.location = 'addRentalItem.php';
	} else {
		alert("CANCELED");
	}
}

function searchItem() {
		window.location = 'searchRentalItem.php';
}

function searchRentalInventory(itemID, itemBrand, itemType, itemSize, itemQuantity) {
	newSearch = "";
	added = false; // Needed for commas between search criterea
	if (itemID == "") {
		//alert("productID null");
		itemID = null; // Makes null rather than empty
	} else {
		addString = "itemID=" + itemID; // words to add to query for search
		newSearch = newSearch.concat(addString);  // Add the string to the query
		added = true; // Mark we added something for future commas as needed
	}
	
	if (itemBrand == "") {
		//alert("itemBrand null");
		itemBrand = null;
	} else {
		addString = "itemBrand=" + '"' + itemBrand + '"';
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
	}
	
	if (itemType == "") {
		//alert("itemColor null");
		itemType = null;
	} else {
		addString = "itemType=" + '"' + itemType + '"';
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
	}
	
	if (itemSize == "") {
		//alert("itemPrice null");
		itemSize = null;
	} else {
		addString = "itemSize=" + '"' + itemSize + '"';
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
	}
	
	if (itemQuantity == "") {
		//alert("itemQuantity null");
		itemQuantity = null;
	} else {
		addString = "itemQuantity=" + '"' + itemQuantity + '"';
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
	}

	// alert("Searching with Query: " + newSearch);
	window.location = "inventoryRental.php?query=true&" + newSearch;
}

function back(){
	window.location = "rentalIndex.php";
}

function searchForRentalOrder(orderID, customerID) {
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
		addString = "customerID=" + '"' + customerID + '"';
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
		window.location = "rentalOrder.php?query=true&" + newSearch;
	}
}

function cancelOrder() {
	if (getSelectedRow() == "") {
		alert("Please select an order to cancel")
	} else {
		if (confirm('Are you sure you wish to cancel Order ID ' + getSelectedRow()) == true) {
			window.location = 'rentalOrder.php?cancel=true&id=' + getSelectedRow();
		} else {
			alert("Did not Cancel Order ID " + getSelectedRow());
		}
	}
}

function generateOrderID() {
	newID = Math.floor(Math.random() * (69999999 - 60000000 + 1)) + 60000000;
	window.location = 'createRentalOrder.php?id=' + newID;
}

function addToOrder(orderID, customerID, items, productID) {
	window.location = 'createRentalOrder.php?id=' + orderID + '&customerID=' + customerID + '&items=' + items + '&itemID=' + productID;
}

function createRentalOrder(orderID, customerID, items, eventDate, returnDate, status){
	window.location = 'addingRentalOrder.php?id=' + orderID + '&customerID=' + customerID + '&orderItems=' + items + '&eventDate=' + eventDate + '&returnDate=' + returnDate +'&orderStatus=' + status;
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

function getCustomerInfo(orderID, customerID) {
	window.location = 'createRentalOrder.php?id=' + orderID + '&customerID=' + customerID;
}