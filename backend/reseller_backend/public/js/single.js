/** PAYMENT CALLBACK OBJECT */
PaymentCallbacks= new Object();

/**
 * SUCCESSFUL PAYMENT CALLBACK
 * 
 * @param {*} message : Success message
 */
PaymentCallbacks.success= (message)=>{
    // Set success message
    $("#payment-success-message")[0].innerText= message;
    // Display modal
    $("#payment-success-modal").modal("show");
};


/**
 * FAILED PAYMENT CALLBACK
 * @param {*} message 
 */
PaymentCallbacks.failure= (message)=>{
    // Set failure message
    $("#payment-failure-message")[0].innerText= message;
    // Display modal
    $("#payment-failure-modal").modal("show");
};