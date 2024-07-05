<?php 

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\TransactionCommission;
use App\Models\User; // Assuming User model is used for customers
use Carbon\Carbon;
use App\Services\Chart;
use Livewire\Component;
use Dompdf\Dompdf;
use Dompdf\Options;

class HomeComponent extends Component
{
    use HasLivewireAuth, HasTable;
    
    public $chartData = [];
    public $dateRange = "";
    public $startDate;
    public $endDate;
    public $chartId;
    public $chartType;
    public $chartHeight;
    public $series;
    public $labels;
    
    protected $queryString = [
        'perPage',
        'sortDirection',
        'search',
        'dateRange',
    ];

    protected $listeners = ['dateRangeUpdated' => 'dateRangeUpdated'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function mount($chartId, $chartType, $chartHeight = 350, $series = [], $labels = [])
    {
        $this->chartId = $chartId;
        $this->chartType = $chartType;
        $this->chartHeight = $chartHeight;
        $this->series = $series;
        $this->labels = $labels;
        
        if ($this->dateRange && strpos($this->dateRange, ' - ') !== false) {
            $dateRange = explode(' - ', $this->dateRange);
            $this->startDate = !empty($dateRange) ? $dateRange[0] : null;
            $this->endDate = !empty($dateRange) ? $dateRange[1] : null;
        } else {
            $this->startDate = null;
            $this->endDate = null;
        }
    
        $this->chartData = $this->getChartData($this->startDate, $this->endDate);
    }

    public function updated($chartId, $chartType, $chartHeight = 350, $series = [], $labels = [])
    {
        $this->chartId = $chartId;
        $this->chartType = $chartType;
        $this->chartHeight = $chartHeight;
        $this->series = $series;
        $this->labels = $labels;
    
        if ($this->dateRange && strpos($this->dateRange, ' - ') !== false) {
            $dateRange = explode(' - ', $this->dateRange);
            $this->startDate = !empty($dateRange) ? $dateRange[0] : null;
            $this->endDate = !empty($dateRange) ? $dateRange[1] : null;
        } else {
            $this->startDate = null;
            $this->endDate = null;
        }
        
        $this->chartData = $this->getChartData($this->startDate, $this->endDate);
    }

    public function render()
    {
        return view('home')
            ->with('transactionReportLink', $this->generateReportLink('transaction'))
            ->with('commissionReportLink', $this->generateReportLink('commission'))
            ->with('customersReportLink', $this->generateReportLink('customer'))
            ->extends('layouts.app');
    }

    public function updateChartData()
    {
        $newSeries = $this->series;
        $newLabels = $this->labels;
        $this->resetPage();
        $this->emit('updateChart', $newSeries, $newLabels);
    }
    
    private function getChartData($startDate = null, $endDate = null)
    {
        $startDate = $startDate ?? Carbon::now()->subDays(30);
        $endDate = $endDate ?? Carbon::now();
        return Chart::getChartData($startDate, $endDate);
    }

    public function generateReportLink($reportType)
    {
        return route('view.report', ['reportType' => $reportType]);
    }

    public function generateReport($reportType)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->generateReportHtml($reportType));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $pdfOutput = $dompdf->output();
        
        $fileName = $reportType . '_report.pdf';
        $filePath = public_path('reports/' . $fileName);
        file_put_contents($filePath, $pdfOutput);
        return $filePath;
    }

    private function generateReportHtml($reportType)
    {
        $html = '';
        $customStyle = '<style>
                            table {
                                width: 100%;
                                border-collapse: collapse;
                            }
                            th, td {
                                border: 1px solid black;
                                padding: 8px;
                                text-align: left;
                            }
                            th {
                                background-color: #f2f2f2;
                            }
                            tr:nth-child(even) {
                                background-color: #f2f2f2;
                            }
                        </style>';
        $html .= $customStyle;
        switch ($reportType) {
            case 'transaction':
                $transactions = Transaction::with('user_platform')->get();
                $html .= '<style>.table-bordered{ border: 1px solid black; tr{  1px solid black;} }</style>';
                $html .= '<div class="container"><h1 class="text-center">Transaction Report</h1>';
                $html .= '<table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Platform name</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>';
                $totalAmount = 0;
                $totalPending = 0;
                $totalFailed = 0;
                $totalSuccess = 0;
                foreach ($transactions as $transaction) {
                    $html .= '<tr>
                                  <td>' . $transaction->id . '</td>
                                  <td>' . $transaction->created_at . '</td>
                                  <td>' . $transaction->user_platform->platform->name . ' </td>
                                  <td>' . $transaction->status . ' </td>
                                  <td>' . $transaction->amount . ' </td>
                              </tr>';
                    $totalAmount += $transaction->amount;
                    if ($transaction->status === 'pending') {
                        $totalPending += $transaction->amount;
                    } elseif ($transaction->status === 'failed') {
                        $totalFailed += $transaction->amount;
                    } elseif ($transaction->status === 'success') {
                        $totalSuccess += $transaction->amount;
                    }
                }
                $html .= '</tbody>
                         </table>';

                // Display total pending, failed, and success transactions in a separate table
                $html .= '<div class="container"><h1 class="text-center">Transaction Summary</h1>';
                $html .= '<table class="table table-bordered table-striped"><thead><tr><th>Status</th><th>Total Amount</th></tr></thead><tbody>';
                $html .= '<tr><td>Pending</td><td>' . $totalPending . ' INR</td></tr>';
                $html .= '<tr><td>Failed</td><td>' . $totalFailed . ' INR</td></tr>';
                $html .= '<tr><td>Success</td><td>' . $totalSuccess . ' INR</td></tr>';
                $html .= '<tr><td>Total</td><td>' . $totalAmount . ' INR</td></tr>';
                $html .= '</tbody></table></div>';
                break;

            case 'commission':
                $commissions = TransactionCommission::all();
                $html .= '<div class="container"><h1 class="text-center">Transaction Commission Report</h1>';
                $html .= '<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>Commission</th><th>Date</th></tr></thead><tbody>';
                $totalCommission = 0;
                foreach ($commissions as $commission) {
                    $html .= '<tr><td>' . $commission->id . '</td><td>' . $commission->commission_amount . ' </td><td>' . $commission->created_at . '</td></tr>';
                    $totalCommission += $commission->commission_amount;
                }
                $html .= '</tbody></table>';
                $html .= '<h4 class="text-center">Total Commission: ' . $totalCommission . ' INR</h4></div>';

            
                break;
            case 'customer':
                $customers = User::all();
                $html .= '<div class="container"><h1 class="text-center">Customer Report</h1>';
                $html .= '<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>Name</th><th>Email</th></tr></thead><tbody>';
                foreach ($customers as $customer) {
                    $html .= '<tr><td>' . $customer->id . '</td><td>' . $customer->name . '</td><td>' . $customer->email . '</td></tr>';
                }
                $html .= '</tbody></table></div>';
                break;

            default:
                $html .= '<div class="container"><h1 class="text-center">No Report Available</h1></div>';
                break;
        }
        
        return $html;
    }
}
