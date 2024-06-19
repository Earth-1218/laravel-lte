
@props(['data'])
<div class="">
    <div class="loan-details d-flex ml-2">
        <p class="ml-3"><strong>User Name:</strong> John Doe</p>
        <p class="ml-3"><strong>Loan Number:</strong> LN123456789</p>
        <p class="ml-3"><strong>Loan Amount:</strong>2,00,000 ₹</p>
        <p class="ml-3"><strong>Partner Commission</strong>1.60 %</p>
        <p class="ml-3"><strong>Applied Date:</strong> 1 Jan. 2024</p>
    </div>
</div>
<div class="timeline">
    <div>
        <i class="fas fa-clock bg-gray"></i>
        <div class="timeline-item">
            <div class="timeline-header bg-secondary d-flex justify-content-between">
                <h5>NOT YET REGISTERED</h5>
                <h5>01/01/2024</h5>
            </div>
            <div class="timeline-body">
                Your loan application has not yet been registered. Please initiate the process to move forward. 
                Ensure you have all necessary documents ready before starting the application to streamline the process.
            </div>
        </div>
    </div>
    <div>
        <i class="fas fa-file-alt bg-yellow"></i>
        <div class="timeline-item">
            <div class="timeline-header bg-yellow d-flex justify-content-between">
                <h5>DOCUMENT SUBMITTED</h5>
                <h5>02/01/2024</h5>
            </div>
            <div class="timeline-body">
                Your documents have been successfully submitted. Our team will review them shortly. 
                This includes verifying your identity, income, and other relevant information to ensure everything is in order.
            </div>
        </div>
    </div>
    <div>
        <i class="fas fa-cogs bg-blue"></i>
        <div class="timeline-item">
            <div class="timeline-header bg-blue d-flex justify-content-between">
                <h5>LOAN UNDER PROCESS</h5>
                <h5>04/01/2024</h5>
            </div>
            <div class="timeline-body">
                Your loan application is currently under process. We are evaluating the submitted documents and checking all details.
                This stage involves a thorough review to ensure the accuracy and completeness of your application.
            </div>
        </div>
    </div>
    <div>
        <i class="fas fa-check bg-purple"></i>
        <div class="timeline-item">
            <div class="timeline-header bg-purple d-flex justify-content-between">
                <h5>LOAN APPROVED</h5>
                <h5>22/01/2024</h5>
            </div>
            <div class="timeline-body">
                Congratulations! Your loan has been approved. The next step is the loan sanctioning process. 
                You will receive detailed information about the approved amount and terms soon.
            </div>
        </div>
    </div>
    <div>
        <i class="fas fa-stamp bg-maroon"></i>
        <div class="timeline-item">
            <div class="timeline-header bg-maroon d-flex justify-content-between">
                <h5>LOAN SANCTIONED</h5>
                <h5>01/02/2024</h5>
            </div>
            <div class="timeline-body">
                Your loan has been officially sanctioned. The sanctioned amount will be credited soon. 
                Please ensure your bank details are up-to-date to avoid any delays in the crediting process.
            </div>
        </div>
    </div>
    <div>
        <i class="fas fa-dollar-sign bg-green"></i>
        <div class="timeline-item">
            <div class="timeline-header bg-green d-flex justify-content-between">
                <h5>AMOUNT CREDITED</h5>
                <h5>02/02/2024</h5>
            </div>
            <div class="timeline-body">
                The loan amount has been successfully credited to your bank account. Thank you for choosing our services.
                You can now use the funds as needed. Please contact us if you have any questions or require further assistance.
            </div>
        </div>
    </div>
    <div>
        <i class="fas fa-check bg-green"></i>
    </div>
</div>



