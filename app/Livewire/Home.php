<?php

namespace App\Livewire;

use Livewire\Component;

use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\FilterExpression;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Google\Analytics\Data\V1beta\Filter\InListFilter;
use Google\Analytics\Data\V1beta\Filter\StringFilter;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home');
    }

    // Active Users from UK & US
    public function fetch()
    {
        $credentialsPath = storage_path('app/google/' . config('app.filename'));
        $property_id = config('app.property_id');
        $client = new BetaAnalyticsDataClient([
            'credentials' => $credentialsPath
        ]);
        $request = (new RunReportRequest())
            ->setProperty('properties/' . $property_id)
            ->setDateRanges([
                new DateRange([
                    'start_date' => '2024-08-01',
                    'end_date' => 'today',
                ]),
            ])
            ->setDimensions([
                new Dimension([
                    'name' => 'country',
                ]),
            ])
            ->setMetrics([
                new Metric([
                    'name' => 'activeUsers',
                ]),
            ]);
        $response = $client->runReport($request);
        $totalActiveUsersUS = 0;
        $totalActiveUsersUK = 0;
        foreach ($response->getRows() as $row) {
            $country = $row->getDimensionValues()[0]->getValue();
            $activeUsers = (int) $row->getMetricValues()[0]->getValue();

            if ($country === 'United States') {
                $totalActiveUsersUS += $activeUsers;
            } elseif ($country === 'United Kingdom') {
                $totalActiveUsersUK += $activeUsers;
            }
        }
        $data = [
            'US' => $totalActiveUsersUS,
            'UK' => $totalActiveUsersUK,
        ];
        dd($data);
    }

    // Active Users from a country
    /*public function fetch()
    {
        $credentialsPath = storage_path('app/google/' . config('app.filename'));
        $property_id = config('app.property_id');
        $client = new BetaAnalyticsDataClient([
            'credentials' => $credentialsPath
        ]);
        $request = (new RunReportRequest())
            ->setProperty('properties/' . $property_id)
            ->setDateRanges([
                new DateRange([
                    'start_date' => '2024-07-01',
                    'end_date' => 'today',
                ]),
            ])
            ->setDimensions([
                new Dimension([
                    'name' => 'country',
                ]),
            ])
            ->setMetrics([
                new Metric([
                    'name' => 'activeUsers',
                ]),
            ]);
        $response = $client->runReport($request);
        $data = [];
        foreach ($response->getRows() as $row) {
            $data[] = [
                'country' => $row->getDimensionValues()[0]->getValue(),
                'activeUsers' => $row->getMetricValues()[0]->getValue(),
            ];
        }
        dd($data);
    }*/

    // PageViews - eventCount
    /*public function fetch()
    {
        $credentialsPath = storage_path('app/google/' . config('app.filename'));
        $property_id = config('app.property_id');
        $client = new BetaAnalyticsDataClient([
            'credentials' => $credentialsPath
        ]);
        $request = (new RunReportRequest())
            ->setProperty('properties/' . $property_id)
            ->setDateRanges([
                new DateRange([
                    'start_date' => '2024-07-01',
                    'end_date' => 'today',
                ]),
            ])
            ->setMetrics([
                new Metric([
                    'name' => 'screenPageViews',
                ]),
                new Metric([
                    'name' => 'eventCount',
                ]),
            ]);
        $response = $client->runReport($request);
        $data = [];
        foreach ($response->getRows() as $row) {
            $data[] = [
                'screenPageViews' => $row->getMetricValues()[0]->getValue(),
                'eventCount' => $row->getMetricValues()[1]->getValue(),
            ];
        }
        dd($data);
    }*/

    // Default - Official Documentation
    /*public function fetch()
    {
        $credentialsPath = storage_path('app/google/' . config('app.filename'));
        $property_id = config('app.property_id');
        $client = new BetaAnalyticsDataClient([
            'credentials' => $credentialsPath
        ]);
        $request = (new RunReportRequest())
            ->setProperty('properties/' . $property_id)
            ->setDateRanges([
                new DateRange([
                    'start_date' => '2023-03-31',
                    'end_date' => 'today',
                ]),
            ])
            ->setDimensions([
                new Dimension([
                    'name' => 'city',
                ]),
            ])
            ->setMetrics([
                new Metric([
                    'name' => 'activeUsers',
                ])
            ]);
        $response = $client->runReport($request);
        $data = [];
        foreach ($response->getRows() as $row) {
            $data[] = [
                'city' => $row->getDimensionValues()[0]->getValue(),
                'activeUsers' => $row->getMetricValues()[0]->getValue(),
            ];
        }
        dd($data);
    }*/
}
