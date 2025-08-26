<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form detail</title>
    <style>
        .header-style{
            background-color: yellow;
            padding: 5px;
            padding-left: 15px;
        }
        .tr-odd{
            background-color: rgb(238, 238, 238);
        }
        td, th{
            padding: 0.3rem 0.5rem;
        }
    </style>
</head>

<body>
    <table style="border: 1px solid black; width:100%; max-width:1000px; margin:auto;">
        <thead>
            <tr class="header-style">
                <td colspan="2">
                    <h2>Pre-MPDR</h2>
                    <h5>PT Sinar Meadow International Indonesia</h5>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>Dear <strong>{{$user->name}}</strong>,</p>
                    <p>A new MPDR request is submitted for your review and approval. Please review the details below:</p>
                </td>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <th colspan="2">
                        <h5 class="text-center">MARKETING PRODUCT DEVELOPMENT REQUEST</h5>
                    </th>
                </tr>
            
                <tr class="tr-odd">
                    <td width="40%">No Reg:</td>
                    <td width="60">{{$form->no}}</td>
                </tr>
                <tr>
                    <td>Product Name:</td>
                    <td>{{$form->product_name ?? ''}}</td>
                </tr>
                <tr class="tr-odd">
                    <td>Level Priority:</td>
                    <td>{{$form->level_priority ?? ''}}</td>
                </tr>
                <tr>
                    <td>Initiator:</td>
                    <td>{{$form->initiator ?? ''}}</td>
                </tr>
                <tr class="tr-odd">
                    <td>Rational For Development:</td>
                    <td>{{$form->detail->rational_for_development ?? ''}}</td>
                </tr>
                <tr>
                    <td>Product Category:</td>
                    <td>
                        <p>{{$form->category->category ?? ''}}</p>
                        <p>{{$form->category->other ?? ''}}</p>
                    </td>
                </tr>
                <tr class="tr-odd">
                    <td>Channel:</td>
                    <td>
                        <p>{{$form->channel->category ?? ''}}</p>
                        <p>{{$form->channel->country ?? ''}}</p>
                    </td>
                </tr>
                <tr>
                    <th>GENERAL PRODUCT DESCRIPTION AND FUNCTION</th>
                    <td></td>
                </tr>
                <tr class="tr-odd">
                    <td>Product Description (Form/Color/Flavor brief):</td>
                    <td>{!! $form->description->product_description ?? '' !!}</td>
                </tr>
                <tr>
                    <td>Usage Description (Application in customer):</td>
                    <td>{!! $form->description->usage_description ?? '' !!}</td>
                </tr>
                <tr class="tr-odd">
                    <td>Storage Temperature:</td>
                    <td>{{ $form->description->storage_temperature ?? '' }}</td>
                </tr>
                <tr>
                    <td>Delivery Temperature:</td>
                    <td>{{ $form->description->delivery_temperature ?? '' }}</td>
                </tr>
                <tr class="tr-odd">
                    <td>Certification Requirement:</td>
                    <td>
                        <p>{{ $form->certification->category ?? '' }}</p> 
                        <p>{{ $form->certification->other ?? '' }}</p>
                    </td>
                </tr>
                <tr>
                    <th>Competitor's Product to Match or to Beat</th>
                    <td></td>
                </tr>
                @if(isset($form->competitor))
                    @foreach($form->competitor as $index => $competitor)
                    <tr class="tr-odd">
                        <td>Product Name {{$index+1}}</td>
                        <td>{{$competitor->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Size {{$index+1}}</td>
                        <td>{{$competitor->size ?? ''}}</td>
                    </tr>
                    <tr class="tr-odd">
                        <td>Packaging {{$index+1}}</td>
                        <td>{{$competitor->packaging ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Price Indication {{$index+1}}</td>
                        <td>{{$competitor->price ?? ''}}</td>
                    </tr>
                    @endforeach
                @endif
                <tr class="tr-odd">
                    <th>Detailed Packaging Required</th>
                    <td></td>
                </tr>
                <tr>
                    <td>Weight of Product (kg/carton):</td>
                    <td>{{ $form->packaging->weight ?? '' }}</td>
                </tr>
                <tr class="tr-odd">
                    <td>Packaging:</td>
                    <td>
                        <p>{{ $form->packaging->category ?? '' }} </p>
                        <p>{{ $form->packaging->detail ?? '' }}</p>
                    </td>
                </tr>
                <tr>
                    <td>Product Variation List:</td>
                    <td>{{ $form->packaging->product_variation ?? '' }}</td>
                </tr>
                <tr class="tr-odd">
                    <th>MARKET UPDATE</th>
                    <td></td>
                </tr>
                <tr>
                    <td>Potential Volume (Mt/Annually):</td>
                    <td>{{ $form->market->potential_volume ?? '' }}</td>
                </tr>
                <tr class="tr-odd">
                    <td><b>Pricing Strategy</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Expected Margin (%):</td>
                    <td>{{ $form->market->expected_margin ?? '' }}</td>
                </tr>
                <tr class="tr-odd">
                    <td>Price Estimate:</td>
                    <td>{{ $form->market->price_estimate ?? '' }}</td>
                </tr>
                <tr>
                    <td>TARGET LAUNCH (as Initiator request):</td>
                    <td>{{ $form->detail->target_launch ?? '' }}</td>
                </tr>
                <tr class="tr-odd">
                    <th colspan="2">
                        <a href="{{$approvalNotReviewLink}}" target="_blank" value="approve" style="text-decoration: none; color: green; font-size: 24px; font-weight: bold; margin-right: 20px;">
                            Approve
                        </a>
                        <a href="{{$approvalWithReviewLink}}" target="_blank" value="approve with review" style="text-decoration: none; color: orange; font-size: 24px; font-weight: bold;">
                            Approve with Review
                        </a>
                        <a href="{{$notApproveLink}}" target="_blank" value="not approve" style="text-decoration: none; color: red; font-size: 24px; font-weight: bold; margin-left: 20px;">
                            Not Approve
                        </a>
                    </th>
                </tr>

                <tr>
                    <td colspan="2">
                        <p style="text-align: center;">Kindly approve it at your earliest convenience so we can proceed.</p>
                        <p style="text-align: center;">Thank you for your attention.</p>
                        <br>
                        <p style="text-align: center;">Best regards,</p>
                        <p style="text-align: center;">PT Sinar Meadow International Indonesia</p>
                    </td>
                </tr>
        </tbody>
    </table>
</body>
</html>