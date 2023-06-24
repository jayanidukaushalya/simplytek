function toggleView() {

    var signin = document.getElementById("signin");
    var login = document.getElementById("login");

    signin.classList.toggle("d-none");
    login.classList.toggle("d-none");

}

function signUp() {

    var e = document.getElementById("email");
    var p = document.getElementById("password");

    var form = new FormData;
    form.append("e", e.value);
    form.append("p", p.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "65668") {
                document.getElementById("msgdiv").classList.add("d-none");
                alert("User registered successfully!");
                window.location = "index.php";
            } else {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msgdiv").classList.remove("d-none");
            }
        }
    }

    request.open("POST", "signUpProcess.php", true);
    request.send(form);

}

function login() {

    var e = document.getElementById("email2");
    var p = document.getElementById("password2");
    var r = document.getElementById("r");

    var form = new FormData;
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("r", r.checked);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var text = request.responseText;
            if (text == "69887") {
                document.getElementById("msgdiv2").classList.add("d-none");
                window.location = "index.php";
            } else {
                document.getElementById("msg2").innerHTML = text;
                document.getElementById("msgdiv2").classList.remove("d-none");
            }
        }
    }

    request.open("POST", "loginProcess.php", true);
    request.send(form);

}

function m() {

    var slider = document.getElementById("slider-price");
    var min = slider.datamin.value;

}

function showPassword() {

    var input = document.getElementById("npi");
    var i = document.getElementById("npb");

    if (input.type == "password") {
        input.type = "text";
        i.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
    } else {
        input.type = "password";
        i.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
    }

}

function showReTypePassword() {

    var input = document.getElementById("rpi");
    var i = document.getElementById("rpb");

    if (input.type == "password") {
        input.type = "text";
        i.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
    } else {
        input.type = "password";
        i.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
    }

}

var show;

function forgotPassword() {

    var email = document.getElementById("email2").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Verification code has sent to your email, please check your inbox!");

                var modal = document.getElementById("modal");

                show = new bootstrap.Modal(modal);
                show.show();
            } else {
                alert(response);
            }
        }
    };

    request.open("GET", "forgotPasswordProcess.php?e=" + email, true);
    request.send();

}

function resetPassword() {

    var email = document.getElementById("email2").value;
    var np = document.getElementById("npi").value;
    var rnp = document.getElementById("rpi").value;
    var code = document.getElementById("vc").value;

    var form = new FormData();
    form.append("e", email);
    form.append("n", np);
    form.append("r", rnp);
    form.append("v", code);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                show.hide();
                alert("Your password is recovered successfully!")
            } else {
                alert(response);
            }
        }
    };

    request.open("POST", "resetPasswordProcess.php", true);
    request.send(form);

}

function searchProducts() {

    var input = document.getElementById("search").value;
    var select = document.getElementById("select-search").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;
            document.body.innerHTML = response;
        }

    }

    request.open("GET", "searchProductsProcessing.php?i=" + input + "&s=" + select, true);
    request.send();

}

function searchProductsMobile() {

    var input = document.getElementById("search-mob").value;
    var select = document.getElementById("select-search-mob").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {

        if (request.readyState == 4) {

            var response = request.responseText;
            document.body.innerHTML = response;
        }

    }

    request.open("GET", "searchProductsProcessing.php?i=" + input + "&s=" + select, true);
    request.send();

}

function changeImage(id) {

    var main = document.getElementById("main-image");
    var img = document.getElementById(id);

    var main_src = main.src;
    var img_src = img.src;

    main.src = img_src;
    img.src = main_src;

}

function a() {

    var select = document.getElementById('color-select');

    if (document.getElementById('brand-select').value == '') {

        select.setAttribute('disabled', '');
        select.selectedIndex = 0;

    } else {

        select.removeAttribute('disabled');

    }

}

function advanceSearch() {

    var brand = document.getElementById("brand-select").value;
    var color = document.getElementById("color-select").value;
    var input = document.getElementById("search-input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {

            var response = request.responseText;
            if (response != "no") {
                document.getElementById("add-filters").innerHTML = "";
                document.getElementById("add-filters").innerHTML = response;
            }

        }
    }

    request.open("GET", "filter.php?b=" + brand + "&c=" + color + "&i=" + input);
    request.send();

}

function applyFilters() {

    var low_price = document.getElementById("lower-price").value;
    var high_price = document.getElementById("greater-price").value;
    var new_condition = document.getElementById("check-condition-1").checked;
    var used_condition = document.getElementById("check-condition-2").checked;
    var time_dsc = document.getElementById("check-active-time-1").checked;
    var time_asc = document.getElementById("check-active-time-2").checked;
    var rating = document.getElementById("check-rating").checked;
    var low_high = document.getElementById("check-price-1").checked;
    var high_low = document.getElementById("check-price-2").checked;

    var brand = document.getElementById("brand-select").value;
    var color = document.getElementById("color-select").value;
    var input = document.getElementById("search-input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {

            var response = request.responseText;
            document.getElementById("add-filters").innerHTML = "";
            document.getElementById("add-filters").innerHTML = response;

        }
    }

    request.open("GET", "filter2.php?b=" + brand + "&c=" + color + "&i=" + input +
        "&lp=" + low_price + "&hp=" + high_price + "&td=" + time_dsc + "&ta=" + time_asc +
        "&cn=" + new_condition + "&cu=" + used_condition +
        "&r=" + rating + "&plh=" + low_high + "&phl=" + high_low);
    request.send();

}

function addToCart(id, i, j) {

    var color = document.getElementById("color-id-" + i + "-" + j).value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 41232) {
                alert("Done!");
                window.location = "index.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "addToCartProcessing.php?id=" + id + "&c=" + color, true);
    request.send();

}

function addToCart2(id, i) {

    var color = document.getElementById("color-id-" + i).value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 41232) {
                alert("Done!");
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "addToCartProcessing.php?id=" + id + "&c=" + color, true);
    request.send();

}

function addToCart3(id) {

    var color = document.getElementById("color-id").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 41232) {
                alert("Done!");
                window.location = "productView.php?id=" + id;
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "addToCartProcessing.php?id=" + id + "&c=" + color, true);
    request.send();

}

function addToWishList(id, i, j) {

    var color = document.getElementById("color-id-" + i + "-" + j).value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 41232) {
                alert("Done!");
                window.location = "index.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "addToWishListProcessing.php?id=" + id + "&c=" + color, true);
    request.send();

}

function addToWishList2(id, i) {

    var color = document.getElementById("color-id-" + i).value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 41232) {
                alert("Done!");
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "addToWishListProcessing.php?id=" + id + "&c=" + color, true);
    request.send();

}

function addToWishList3(id) {

    var color = document.getElementById("color-id").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 41232) {
                alert("Done!");
                window.location = "wishlist.php?id=" + id;
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "addToWishListProcessing.php?id=" + id + "&c=" + color, true);
    request.send();

}

function setColor(id, i, j) {

    document.getElementById("color-id-" + i + "-" + j).setAttribute("value", id);

}

function setColor2(id, i) {

    document.getElementById("color-id-" + i).setAttribute("value", id);

}

function setColor3(id) {

    document.getElementById("color-id").setAttribute("value", id);

}

function numbersOnly(evt) {

    var ascii = evt.keyCode || evt.which;
    if (ascii >= 0 && ascii <= 127) {
        return false;
    } else {
        return true;
    }

}

function minus(id, cid) {

    var qty = parseInt(document.getElementById(id).value);

    if (qty == "") {
        qty = 0;
    }

    if (qty < 0) {
        qty = 0;
    }

    if (qty > 0) {
        qty -= 1;
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 24233) {
                window.location = "cart.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "updateQty.php?qty=" + qty + "&id=" + cid, true);
    request.send();

}

function plus(id, cid) {

    var qty = parseInt(document.getElementById(id).value);

    if (qty == "") {
        qty = 0;
    }

    if (qty < 0) {
        qty = 0;
    }

    if (qty >= 0) {
        qty += 1;
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 24233) {
                window.location = "cart.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "updateQty.php?qty=" + qty + "&id=" + cid, true);
    request.send();

}

function removeProduct(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 54578) {
                window.location = "cart.php";
            }
        }
    }

    request.open("GET", "removeProductProcessing.php?id=" + id, true);
    request.send();

}

function removeWishProduct(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 54578) {
                window.location = "wishlist.php";
            }
        }
    }

    request.open("GET", "removeWishProductProcessing.php?id=" + id, true);
    request.send();

}

function updateQty(id) {

    var qty = document.getElementById(id).value;
    alert(qty);
}

function payNow(sub_total, discount, delivery, net_total) {

    var delivery_id = "";

    try {

        delivery_id = document.getElementById("delivery-id").value;



        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (request.readyState == 4) {

                var response = request.responseText;

                var object = JSON.parse(response);

                var email = object["email"];
                var order_id = object["oid"];
                var reg_fname = object["reg_fname"];
                var reg_lname = object["reg_lname"];
                var reg_mobile = object["reg_mobile"];

                saveInvoice(email, order_id, sub_total, discount, delivery, net_total, delivery_id);

                

            }
        }

        request.open("GET", "buyNowProcess.php?s=" + sub_total + "&d=" + discount + "&l=" + delivery + "&n=" + net_total + "&did=" + delivery_id, true);
        request.send();

    } catch (error) {
        alert("Shopping address is not defined, please add your shopping address");
    }

    // Visa : 4916217501611292
    // MasterCard : 5307732125531191
    // AMEX : 346781005510225

}

function saveInvoice(email, order_id, sub_total, discount, delivery, net_total, delivery_id) {

    var form = new FormData();

    form.append("e", email);
    form.append("o", order_id);
    form.append("s", sub_total);
    form.append("d", discount);
    form.append("l", delivery);
    form.append("n", net_total);
    form.append("di", delivery_id);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == "ok") {
                generatePDF(order_id);
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveInvoiceProcessing.php", true);
    request.send(form);

}

function viewAddNewAddress() {

    var div = document.getElementById("new-address");

    div.classList.toggle("d-none");
    div.classList.toggle("d-block");

}

function updateDeliveryAddress(isEmpty) {

    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var address = document.getElementById("shopping-address").value;
    var city = document.getElementById("city").value;
    var mobile = document.getElementById("mobile").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 2112) {
                window.location = "cart.php"
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "updateDeliveryAddressProcessing.php?f=" + fname + "&l=" + lname + "&a=" + address + "&c=" + city + "&m=" + mobile + "&e=" + isEmpty, true);
    request.send();

}

function generatePDF(order_id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {

            var response = request.responseText;

            var opt = {
                margin: 1,
                filename: 'simplytekInvoice.pdf',
                image: { type: 'png', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            html2pdf().set(opt).from(response).save();

            setTimeout(() => {
                window.location = "cart.php";
            }, 3000);

        }
    }

    request.open("GET", "invoice.php?id=" + order_id, true);
    request.send();

}

var show_feedbackModal;
var product_id;
var invoiceItem_id;

function openFeedback(id, itId) {

    product_id = id;
    invoiceItem_id = itId;

    modal = document.getElementById("feedback-modal");

    var show_feedbackModal = new bootstrap.Modal(modal);
    show_feedbackModal.show();

}

function sendFeedback() {

    var review = document.getElementById("review-text").value;

    var rate1 = document.getElementById("star1");
    var rate2 = document.getElementById("star2");
    var rate3 = document.getElementById("star3");
    var rate4 = document.getElementById("star4");
    var rate5 = document.getElementById("star5");

    if (rate1.checked) {
        rate1 = rate1.value;
        rate2 = "";
        rate3 = "";
        rate4 = "";
        rate5 = "";
    } else if (rate2.checked) {
        rate2 = rate2.value;
        rate1 = "";
        rate3 = "";
        rate4 = "";
        rate5 = "";
    } else if (rate3.checked) {
        rate3 = rate3.value;
        rate2 = "";
        rate1 = "";
        rate4 = "";
        rate5 = "";
    } else if (rate4.checked) {
        rate4 = rate4.value;
        rate2 = "";
        rate3 = "";
        rate1 = "";
        rate5 = "";
    } else if (rate5.checked) {
        rate5 = rate5.value;
        rate2 = "";
        rate3 = "";
        rate4 = "";
        rate1 = "";
    } else {
        rate1 = "";
        rate2 = "";
        rate3 = "";
        rate4 = "";
        rate5 = "";
    }

    var form = new FormData();

    form.append("r1", rate1);
    form.append("r2", rate2);
    form.append("r3", rate3);
    form.append("r4", rate4);
    form.append("r5", rate5);
    form.append("r6", review);
    form.append("id", product_id);
    form.append("itId", invoiceItem_id);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 21132) {
                window.location = "purchasedHistory.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "sendFeedbackProcess.php", true);
    request.send(form);
}

function removePurchasedHistoryItem(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 2131) {
                window.location = "purchasedHistory.php";
            }
        }
    }

    request.open("GET", "removePurchasedHistoryItemProcess.php?id=" + id, true);
    request.send();

}

function clearAllRecords() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 4522) {
                window.location = "purchasedHistory.php";
            }
        }
    }

    request.open("GET", "clearAllRecordsProcess.php", true);
    request.send();

}

function updateProfile() {

    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var mobile = document.getElementById("mobile").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 98252) {
                window.location = "profile.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "updateProfileProcess.php?f=" + fname + "&l=" + lname + "&m=" + mobile, true);
    request.send();

}

function adminLogin() {

    var email = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var form = new FormData();

    form.append("e", email);
    form.append("p", password);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == 42321) {
                window.location = "listitems.php";
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "adminLoginProcessing.php", true);
    request.send(form);

}

var adminShow;

function forgotPasswordAdmin() {

    var email = document.getElementById("username").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                alert("Verification code has sent to your email, please check your inbox!");

                var modal = document.getElementById("modal");

                adminShow = new bootstrap.Modal(modal);
                adminShow.show();
            } else {
                alert(response);
            }
        }
    };

    request.open("GET", "forgotAdminPasswordProcess.php?e=" + email, true);
    request.send();

}

function resetAdminPassword() {

    var email = document.getElementById("username").value;
    var np = document.getElementById("npi").value;
    var rnp = document.getElementById("rpi").value;
    var code = document.getElementById("vc").value;

    var form = new FormData();
    form.append("e", email);
    form.append("n", np);
    form.append("r", rnp);
    form.append("v", code);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                adminShow.hide();
                alert("Your password is recovered successfully!")
            } else {
                alert(response);
            }
        }
    };

    request.open("POST", "resetAdminPasswordProcess.php", true);
    request.send(form);

}

function addVariations() {

    var div = document.getElementById("div");
    var id = document.getElementById("id");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            document.getElementById("div-variation").innerHTML += request.responseText;
            document.getElementById("id").value = parseInt(id.value) + 1;
        }
    }

    request.open("GET", "add.php?id=" + id.value, true);
    request.send();

}

function removeVariations(id) {

    document.getElementById("color-div-" + id).remove();
    document.getElementById("qty-div-" + id).remove();

}

function newItem() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var condition = document.getElementById("condition");
    var name = document.getElementById("name");
    var price = document.getElementById("price");
    var discount = document.getElementById("discount");

    var mainImg = document.getElementById("main-image");
    var otherImg = document.getElementById("other-image");
    var description = document.getElementById("description");

    var imgCount = otherImg.files.length;

    var form = new FormData();

    form.append("image0", mainImg.files[0]);

    for (var i = 0; i < imgCount; i++) {
        form.append("image" + (i + 1), otherImg.files[i]);
    }

    var color = document.getElementById("color");
    var qty = document.getElementById("qty");

    if (mainImg.value == "") {
        form.append("main", 0);
    } else {
        form.append("main", 1);
    }
    form.append("cat", category.value);
    form.append("b", brand.value);
    form.append("con", condition.value);
    form.append("n", name.value);
    form.append("pr", price.value);
    form.append("di", discount.value);
    form.append("de", description.value);
    form.append("col", color.value);
    form.append("q", qty.value);

    var variations = document.getElementById("id").value;
    form.append("count", variations);
    if(variations > 0) {
        for(var i = 1; i <= variations; i++) {
            form.append("col-"+i, document.getElementById("color-"+i).value);
            form.append("q-"+i, document.getElementById("qty-"+i).value);
        }
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            var response = request.responseText;
            if(response == 21312) {
                alert("Product added successfully!")
                location.reload();
            }
        }
    }

    request.open("POST", "listItemProcessing.php", true);
    request.send(form);

}

function changeMainImage() {

    var view = document.getElementById("main-img-tag"); //img tag
    var file = document.getElementById("main-image"); //file chooser

    file.onchange = function() {
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
        document.getElementById("div-main-image").classList.remove("p-5");
        document.getElementById("div-main-image").classList.add("p-3");
        document.getElementById("main-img-tag").classList.remove("opacity-75");
    }

}

function changeOtherImage() {

    var image = document.getElementById("other-image"); //file chooser

    image.onchange = function() {

        var count = this.files.length;

        if (count <= 8) {

            for (var x = 8; x > count; x--) {

                document.getElementById("other-img-tag" + (x - 2)).src = "resources/img.png";
                document.getElementById("div-other-image" + (x - 2)).classList.add("p-5");
                document.getElementById("div-other-image" + (x - 2)).classList.remove("p-3");
                document.getElementById("other-img-tag" + (x - 2)).classList.add("opacity-75");

            }

            for (var x = 0; x < count; x++) {

                var image = this.files[x];
                var url = window.URL.createObjectURL(image);
                document.getElementById("other-img-tag" + x).src = url;
                document.getElementById("div-other-image" + x).classList.remove("p-5");
                document.getElementById("div-other-image" + x).classList.add("p-3");
                document.getElementById("other-img-tag" + x).classList.remove("opacity-75");

            }


        } else {
            alert("Please select 7 or less than 7 images.");
        }

    }

}

function removeImage1() {

    document.getElementById("main-img-tag").src = "resources/img.png";
    document.getElementById("div-main-image").classList.add("p-5");
    document.getElementById("div-main-image").classList.remove("p-3");
    document.getElementById("main-img-tag").classList.add("opacity-75");

    document.getElementById("main-image").value = "";

}

function removeImage2() {

    for (var x = 0; x < 8; x++) {
        document.getElementById("other-img-tag" + x).src = "resources/img.png";
        document.getElementById("div-other-image" + x).classList.add("p-5");
        document.getElementById("div-other-image" + x).classList.remove("p-3");
        document.getElementById("other-img-tag" + x).classList.add("opacity-75");
    }

    document.getElementById("other-image").value = "";

}

function hideItem(id) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.responseText = 3333) {
                document.getElementById("btn-visible").classList.remove("d-none");
                document.getElementById("btn-hide").classList.add("d-none");
            }
        }
    }
    request.open("GET", "hideItem.php?id="+id, true);
    request.send();
}


function VisibleItem(id) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.responseText = 4444) {
                document.getElementById("btn-visible").classList.add("d-none");
                document.getElementById("btn-hide").classList.remove("d-none");
            }
        }
    }
    request.open("GET", "visibleItem.php?id="+id, true);
    request.send();
}