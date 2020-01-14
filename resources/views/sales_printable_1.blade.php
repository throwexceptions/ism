<p>&nbsp;</p>
<div>
    <table>
        <tbody>
        <tr>
            <td>Project</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><strong>{{ $sales_order->customer_name }}</strong></td>
        </tr>
        <tr>
            <td>Location:</td>
            <td></td>
            <td><strong>{{ $sales_order->address }}</strong></td>
        </tr>
        <tr>
            <td>Contact Person:</td>
            <td>&nbsp;</td>
            <td><strong>{{ $sales_order->agent }}</strong></td>
        </tr>
        <tr>
            <td>Date:</td>
            <td>&nbsp;</td>
            <td><strong>{{ \Carbon\Carbon::now()->format('F j, Y') }}</strong></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Subject:</td>
            <td>&nbsp;</td>
            <td><strong>{{ $sales_order->subject }}</strong></td>
        </tr>
        </tbody>
    </table>
</div>
<div>
    <p>&nbsp;</p>
</div>
<div>
    <table style="border: 2px solid black; border-collapse: collapse;" border="1" width="100%">
        <tbody>
        <tr style="background-color: #bdd6ee;">
            <td style="text-align: center;"><strong>Description</strong></td>
            <td style="text-align: center;"><strong>Quantity</strong></td>
            <td style="text-align: center;"><strong>Unit</strong></td>

            <td style="text-align: center;"><strong>Unit Cost</strong></td>
            <td style="text-align: center;"><strong>Total Cost</strong></td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Unit Cost</td>
                        <td>Total Cost</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;"><strong>TOTAL ITEM COST</strong></td>
        </tr>
        <tr style="background-color: #fefb04;">
            <td>PRELIMINARIES</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tbody>
                    <tr>
                        <td>MOBILIZATION</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">1.00</td>
            <td style="text-align: center;">lot</td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">1,000.00</td>
        </tr>
        <tr style="background-color: #bdd6ee;">
            <td style="text-align: right;">Sub-total I</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;"><strong>1,000.00</strong></td>
        </tr>
        <tr style="background-color: #d8d8d8;">
            <td>&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">&nbsp;</td>
        </tr>
        <tr style="background-color: #fefb04;">
            <td><strong>CCTV SECURITY SYSTEM</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tbody>
                    <tr>
                        <td>HIKVISION 4 CHANNEL KIT 1MP</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">1.00</td>
            <td style="text-align: center;">set/s</td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>5,000.00</td>
                        <td>5,000.00</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">5,000.00</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tbody>
                    <tr>
                        <td>1 TB HDD WD PURPLE</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">1.00</td>
            <td style="text-align: center;">set/s</td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>2,400.00</td>
                        <td>2,400.00</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">2,400.00</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tbody>
                    <tr>
                        <td>CONSUMABLES</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">1.00</td>
            <td style="text-align: center;">set/s</td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>800.00</td>
                        <td>800.00</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">800.00</td>
        </tr>
        <tr>
            <td>
                <table>
                    <tbody>
                    <tr>
                        <td>INSTALLATION FEE PER CAMERA (EXPOSE WIRING)</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">4.00</td>
            <td style="text-align: center;">set/s</td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>700.00</td>
                        <td>2,800.00</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">800.00</td>
        </tr>
        <tr style="background-color: #bdd6ee;">
            <td style="text-align: right;">Sub-total III</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;">
                <table style="margin-left: auto; margin-right: auto;" border="1">
                    <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align: center;"><strong>11,000.00</strong></td>
        </tr>
        </tbody>
    </table>
</div>
<div>
    <p>&nbsp;</p>
</div>
<div>
    <table>
        <tbody>
        <tr>
            <td><strong>Terms and Conditions:</strong></td>
        </tr>
        <tr>
            <td>100% FULL PAYMENT</td>
        </tr>
        <tr>
            <td>1 YEAR warranty for DVR, CCTV, HDD and Monitor</td>
        </tr>
        <tr>
            <td>3 months service warranty</td>
        </tr>
        <tr>
            <td>1 month warranty for adaptop</td>
        </tr>
        </tbody>
    </table>
</div>
<div>
    <p>&nbsp; &nbsp;</p>
</div>
<div>
    <table width="100%">
        <tbody>
        <tr>
            <td>
                <table align="left">
                    <tbody>
                    <tr>
                        <td><strong>Mode of Payment: Deposit or Check</strong></td>
                    </tr>
                    <tr>
                        <td>BDO - BANK</td>
                    </tr>
                    <tr>
                        <td>Account Name;</td>
                    </tr>
                    <tr>
                        <td>Account Number:</td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table style="border: 1px solid black;" align="right">
                    <tbody>
                    <tr>
                        <td><strong>SUMMARY:</strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>I. PRELIMINARIES</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>1,000.00</td>
                    </tr>
                    <tr>
                        <td>II. CCTV SECURITY SYSTEM</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>11,000.00</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><strong>DISCOUNT</strong></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>TOTAL</td>
                        <td><strong>12,000.00</strong></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>12% VAT</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><strong>GRAND TOTAL</strong></td>
                        <td><strong>12,000.00</strong></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div>
    <p>&nbsp;</p>
</div>
<div>
    <p>&nbsp;</p>
</div>
