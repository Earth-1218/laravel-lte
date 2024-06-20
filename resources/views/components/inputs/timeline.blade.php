@props(['loan_history'])
@php
    $user = auth()->user();
    $loan_history = App\Models\LoanHistory::where('user_id', $user->id)->get();
@endphp
<div class="">
    <div class="loan-details d-flex ml-2">
        <p class="ml-3"><strong>User Name:</strong> {{ $user->name }}</p>
    </div>
</div>
<div class="timeline">

    @foreach($loan_history as $history)
        @php
            $icon = '';
            $bgColor = '';
            $title = '';
            $message = '';
            
            switch ($history->status) {
                case \App\Models\LoanHistory::STATUS_NOT_YET_REGISTERED:
                    $icon = 'fas fa-clock';
                    $bgColor = 'bg-gray';
                    $title = 'NOT YET REGISTERED';
                    $message = 'Your loan application has not yet been registered. Please initiate the process to move forward. Ensure you have all necessary documents ready before starting the application to streamline the process.';
                    break;
                case \App\Models\LoanHistory::STATUS_IN_PROGRESS_DOCUMENTS_UPLOADED:
                    $icon = 'fas fa-file-alt';
                    $bgColor = 'bg-yellow';
                    $title = 'DOCUMENT SUBMITTED';
                    $message = 'Your documents have been successfully submitted. Our team will review them shortly. This includes verifying your identity, income, and other relevant information to ensure everything is in order.';
                    break;
                case \App\Models\LoanHistory::STATUS_LOAN_APPROVED:
                    $icon = 'fas fa-cogs';
                    $bgColor = 'bg-blue';
                    $title = 'LOAN UNDER PROCESS';
                    $message = 'Your loan application is currently under process. We are evaluating the submitted documents and checking all details. This stage involves a thorough review to ensure the accuracy and completeness of your application.';
                    break;
                case \App\Models\LoanHistory::STATUS_LOAN_SANCTIONED:
                    $icon = 'fas fa-check';
                    $bgColor = 'bg-purple';
                    $title = 'LOAN APPROVED';
                    $message = 'Congratulations! Your loan has been approved. The next step is the loan sanctioning process. You will receive detailed information about the approved amount and terms soon.';
                    break;
                case \App\Models\LoanHistory::STATUS_AMOUNT_CREDITED:
                    $icon = 'fas fa-stamp';
                    $bgColor = 'bg-maroon';
                    $title = 'LOAN SANCTIONED';
                    $message = 'Your loan has been officially sanctioned. The sanctioned amount will be credited soon. Please ensure your bank details are up-to-date to avoid any delays in the crediting process.';
                    break;
                case \App\Models\LoanHistory::STATUS_AMOUNT_CREDITED:
                    $icon = 'fas fa-dollar-sign';
                    $bgColor = 'bg-green';
                    $title = 'AMOUNT CREDITED';
                    $message = 'The loan amount has been successfully credited to your bank account. Thank you for choosing our services. You can now use the funds as needed. Please contact us if you have any questions or require further assistance.';
                    break;
                default:
                    break;
            }
        @endphp
        <div>
            <i class="{{ $icon }} {{ $bgColor }}"></i>
            <div class="timeline-item">
                <div class="timeline-header {{ $bgColor }} d-flex justify-content-between">
                    <h5>{{ $title }}</h5>
                    <h5>{{ $history->created_at->format('d/m/Y') }}</h5>
                </div>
                <div class="timeline-body">
                    {{ $message }}
                </div>
            </div>
        </div>
    @endforeach
</div>
