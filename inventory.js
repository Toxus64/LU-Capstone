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
    let table = document.getElementById("inventoryTable");
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
			window.location = 'inventory.php?delete=true&id=' + getSelectedRow();
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
			window.location = 'modify.php?id=' + getSelectedRow();
		} else {
			alert("CANCELED");
		}
	}
}

function backInventory() {
	window.location = 'inventory.php';
}

function changeItem(productID, itemName, itemBrand, itemColor, itemPrice, itemQuantity, itemMaxQuantity) {
	if (confirm('Are you sure you want to commit changes?') == true) {
			if(productID != "" && itemName != "" && itemBrand != "" && itemColor != "" && itemPrice != "" && itemQuantity != "" && itemMaxQuantity != "") {
				window.location = 'changing.php?id=' + productID + '&itemName=' + itemName + '&itemBrand=' + itemBrand +'&itemColor=' + itemColor +'&itemPrice=' + itemPrice + '&itemQuantity=' + itemQuantity + '&itemMaxQuantity=' + itemMaxQuantity;
			} else {
				alert("Please fill out all fields")
			}
		} else {
			alert("CANCELED")
		}
}

function addItem() {
	if (confirm('Are you sure you wish to add a new item?') == true) {
		window.location = 'add.php';
	} else {
		alert("CANCELED");
	}
}

function addNewItem(productID, itemName, itemBrand, itemColor, itemPrice, itemQuantity, itemMaxQuantity) {
	if (confirm('Are you sure you want to commit changes?') == true) {
			if(productID != "" && itemName != "" && itemBrand != "" && itemColor != "" && itemPrice != "" && itemQuantity != "" && itemMaxQuantity != "") {
				window.location = 'adding.php?id=' + productID + '&itemName=' + itemName + '&itemBrand=' + itemBrand +'&itemColor=' + itemColor +'&itemPrice=' + itemPrice + '&itemQuantity=' + itemQuantity + '&itemMaxQuantity=' + itemMaxQuantity;
			} else {
				alert("Please fill out all fields")
			}
		} else {
			alert("CANCELED")
		}
}
function generateProductID() {
	newID = Math.floor(Math.random() * (19999999 - 10000000 + 1)) + 10000000;
	window.location = 'add.php?id=' + newID;
}

function searchItem() {
		window.location = 'searchItem.php';
}

function searchInventory(productID, itemName, itemBrand, itemColor, itemPrice, itemQuantity, itemMaxQuantity) {
	newSearch = "";
	added = false; // Needed for commas between search criterea
	if (productID == "") {
		//alert("productID null");
		productID = null; // Makes null rather than empty
	} else {
		addString = "productID=" + productID; // words to add to query for search
		newSearch = newSearch.concat(addString);  // Add the string to the query
		added = true; // Mark we added something for future commas as needed
	}
	
	if (itemName == "") { // Everything same as above, just swapped out variables
		//alert("itemName null");
		itemName = null;
	} else {
		addString = "itemName=" + '"' + itemName + '"';
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
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
	
	if (itemColor == "") {
		//alert("itemColor null");
		itemColor = null;
	} else {
		addString = "itemColor=" + '"' + itemColor + '"';
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
	}
	
	if (itemPrice == "") {
		//alert("itemPrice null");
		itemPrice = null;
	} else {
		addString = "itemPrice=" + itemPrice;
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
		addString = "itemQuantity=" + itemQuantity;
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
	}
	
	if (itemMaxQuantity == "") {
		//alert("itemMaxQuantity null");
		itemMaxQuantity = null;
	} else {
		addString = "itemMaxQuantity=" + itemMaxQuantity;
		if (added) {
		newSearch = newSearch.concat(" AND " + addString);
		} else {
			newSearch = newSearch.concat(addString);	
			added = true;
		}
	}
	// alert("Searching with Query: " + newSearch);
	window.location = "inventory.php?query=true&" + newSearch;
}