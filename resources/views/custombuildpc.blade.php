@extends('layouts.home')

@section('content')

<main class="category">
    <div class="category-header py-5 bg-light d-flex justify-content-center align-items-center">
        <h3 class="my-4 display-5 fw-bold">Build Your PC</h3>

    </div>
    <div class="product-listing" style="background-color:#fff;!important">
        <section class="product-listing-area">
            <div class="container">
                <div class="row">
 
<div class="col-md-9">
       <p class="text-info">The PC configurator of PcComponentes is the perfect tool for you to choose one by one the parts of your computer and try different configurations and budgets.In addition, you can save your settings, print it or generate a link to share it on your social networks.Its use is very simple and intuitive, and in a few steps you can assemble a computer by parts completely to your liking.Get your basic,gaming or professional desktop pc at the best price and for you.Can you ask for more?</p>
        <p class="text-info">
Select the components to configure your PC to measure.
You can check the characteristics of the article and its availability by clicking on its name.<p>
    <table class="table table-bordered ">
        <thead>
            <th>
                COMPONENT
            </th>
            <th>
                SELECTION
            </th>
           
        </thead>
        <tbody>
            <tr>
                <td>Processor (CPU)</td>
                <td>Choose Processor (CPU) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
            <tr>
                <td>Cooling System (CPU Cooler)</td>
                <td>Choose Cooling System (CPU Cooler) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
            <tr>
                <td>Motherboard</td>
                <td>Choose Processor (CPU) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
            <tr>
                <td>Memory (RAM)</td>
                <td>Choose Processor (CPU) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
            <tr>
                <td>Solid State Drive (M.2 SSD)</td>
                <td>Choose Processor (CPU) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
            <tr>
                <td>Solid State Drive (SATA SSD)</td>
                <td>Choose Processor (CPU) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
             <tr>
                <td>Solid State Drive (SATA SSD)</td>
                <td>Choose Processor (CPU) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
             <tr>
                <td>Solid State Drive (SATA SSD)</td>
                <td>Choose Processor (CPU) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
             <tr>
                <td>Solid State Drive (SATA SSD)</td>
                <td>Choose Processor (CPU) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
             <tr>
                <td>Solid State Drive (SATA SSD)</td>
                <td>Choose Processor (CPU) <span class="pull-right" id="btn-cpu"><i class="fa fa-plus"></i></span></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-3">
    <div class="rightPaneldiv" style="">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-center align-middle" colspan="3" style="padding: 18px;background-color:#dddddd36;">
                                                                        <span style="font-size: 18px;">Estimated Wattage: 0W</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center align-middle td_grandtotal" colspan="3" style="padding: 23px;">
                                    <span style="font-size: 18px;">Total Price: Rs. 0/- </span>
                                </td>
                                <input type="hidden" name="grandtotal" id="grandtotal" value="0" spellcheck="false">
                            </tr>
                            <tr class="">
                                <td class="text-center align-middle hoverTable" colspan="3" style="padding: 16px;">
                                    <span style="font-size: 17px;"> Add All To Cart</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center align-middle" colspan="3" style="padding: 9px;background-color:#dddddd36; ">
                                    <span style="font-size: 17px;"><a>Save This Build </a></span>
                                </td>
                            </tr> 
                            <tr>
                                <td class="text-center align-middle" style="padding: 16px;">
                                    <a onclick="create_link();">Create Link</a>
                                </td>
                                <td class="text-center align-middle" style="padding: 16px;">
                                    <a>Mail PDF</a>
                                </td>
                                <td class="text-center align-middle" style="padding: 16px;">
                                    <a onclick="printBuildYourPc();">Print</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center align-middle" style="padding: 16px;">
                                    <a data-toggle="modal" data-target="#md_sociallogin">What'sApp PDF</a>
                                </td>
                                <td class="text-center align-middle" style="padding: 16px;">
                                    <a>Download PDF</a>
                                </td>
                                <td class="text-center align-middle" style="padding: 16px;">
                                    <a onclick="getBuildYourPcLinkToShare();">Share On Social</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle" colspan="3" style="font-size: 14px;">Important: If in Doubt, For Compatibility Assured. Then Contact us at the Support Center </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
</div>
                </div>
        </section>
    </div>
</main>
@endsection     