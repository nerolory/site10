
import { loadCart, sendEmail } from "./main.js";


let cart = {};




$(document).ready(function () {
    loadCart();
    $('.send-email').on('click', sendEmail);
});