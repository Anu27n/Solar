<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        $upkAddressOffice = 'Near IIT Metro Station, Kalyanpur - 208015';
        $upkAddressFactory = 'Village 254, Dubiyana, Shivrajpur, Kanpur Nagar, Near Namaste India Food Ltd. - 209205';
        $upkPhones = ['8005006282', '8114197497', '9336852500', '9412452844'];

        $commonPaymentTerms = "50% interest-free advance along with technically & commercially clear firm order; balance 50% against PI before dispatch.";
        $commonDeliveryTerms = "2-3 weeks from placement of order. Delivery commitment is from the date of receipt of advance payment.";
        $commonWarrantyTerms = "36 months warranty against any manufacturing and/or internal defect from the date of invoice under normal operating conditions and proper use.";

        $profiles = [
            [
                'code' => 'upk_electrical',
                'name' => 'UPK ELECTRICAL PVT. LTD.',
                'tagline' => 'Deals in - HT LT Transformer, Servo Voltage Stabilizer, Online UPS, Step Down Transformer, Isolation Transformer, IGBT Stabilizer, CVCF, Rectifier, VCB, OLTC, LT Electrical Panel, L&T Switchgears',
                'address_office' => $upkAddressOffice,
                'address_factory' => $upkAddressFactory,
                'city' => 'Kanpur',
                'state' => 'Uttar Pradesh',
                'pincode' => '208015',
                'gstin' => null,
                'phones' => $upkPhones,
                'email' => 'upkelectricalspvtltd@gmail.com',
                'website' => null,
                'bank_name' => 'HDFC Bank Ltd.',
                'bank_branch' => 'Kanpur',
                'bank_ac_no' => '50200093710726',
                'bank_ifsc' => 'HDFC0000127',
                'bank_pin' => null,
                'signatory_name' => 'Anil Mishra',
                'signatory_title' => 'G.M.',
                'signatory_phone' => '9412452844',
                'ref_prefix' => 'UPK',
                'ref_year_mode' => 'calendar',
                'default_gst_percent' => 18,
                'default_validity_days' => 60,
                'default_payment_terms' => $commonPaymentTerms,
                'default_delivery_terms' => $commonDeliveryTerms,
                'default_warranty_terms' => "36 months warranty from the date of invoice on balanced type electric parts. With 1st quality oil IS 335 grade, 100% capacity.",
                'default_freight' => 'F.O.R - Freight Extra',
                'default_jurisdiction' => 'Kanpur',
                'default_cover_letter' => "With respect to your requirement of electrical equipment in your organization, we're pleased to offer you our best-in-class ECO SMART range. We are an ISO 9001-2000 BVQI Certified Company with very good installation base in India & abroad. Our high quality products and efficient services to our valued customers have enabled us with ample success.",
                'is_active' => true,
            ],
            [
                'code' => 'upr_solar',
                'name' => 'UPR SOLAR',
                'tagline' => 'Solar Power Solutions - Rooftop, On-Grid, Off-Grid & Hybrid Systems, Solar Pumps, Battery Back-up',
                'address_office' => $upkAddressOffice,
                'address_factory' => $upkAddressFactory,
                'city' => 'Kanpur',
                'state' => 'Uttar Pradesh',
                'pincode' => '208015',
                'gstin' => null,
                'phones' => $upkPhones,
                'email' => 'upkelectricalspvtltd@gmail.com',
                'website' => null,
                'bank_name' => 'HDFC Bank Ltd.',
                'bank_branch' => 'Kanpur',
                'bank_ac_no' => '50200093710726',
                'bank_ifsc' => 'HDFC0000127',
                'bank_pin' => null,
                'signatory_name' => 'Anil Mishra',
                'signatory_title' => 'G.M.',
                'signatory_phone' => '9412452844',
                'ref_prefix' => 'UPRS',
                'ref_year_mode' => 'calendar',
                'default_gst_percent' => 18,
                'default_validity_days' => 60,
                'default_payment_terms' => "30% advance along with purchase order; 60% against delivery / running bills; 10% on completion of installation & commissioning.",
                'default_delivery_terms' => "3-5 weeks ex-factory for equipment supply. Installation & commissioning 4-8 weeks subject to site readiness.",
                'default_warranty_terms' => "Modules: 25 years performance warranty (as per manufacturer). Inverter: 5-10 years as per OEM. Balance of System (BOS) & workmanship: 12 months from date of commissioning.",
                'default_freight' => 'F.O.R Site',
                'default_jurisdiction' => 'Kanpur',
                'default_cover_letter' => "Thank you for considering UPR SOLAR for your solar power requirement. We are pleased to submit our techno-commercial offer for the supply, installation and commissioning of the solar power plant as per your requirement. Our systems are designed to deliver optimum generation, maximum savings on your electricity bill and a long, maintenance-free operating life.",
                'is_active' => true,
            ],
            [
                'code' => 'upr_refrigeration',
                'name' => 'U.P. REFRIGERATION & SALES CO.',
                'tagline' => 'Refrigeration Systems for Cold Storages, Ice Plant, Dairies, Breweries, Chilling Plants, Frozen Food etc.',
                'address_office' => 'Near Pioneer City, Bithoor Road, Kalyanpur, Kanpur',
                'address_factory' => null,
                'city' => 'Kanpur',
                'state' => 'Uttar Pradesh',
                'pincode' => '208017',
                'gstin' => '09DICPM0431G1ZK',
                'phones' => ['9412452844'],
                'email' => 'uprefrigeration9336@gmail.com',
                'website' => null,
                'bank_name' => 'Bank of Baroda',
                'bank_branch' => 'Singhpur Chauraha, Kalyanpur, Kanpur',
                'bank_ac_no' => '34420200000133',
                'bank_ifsc' => 'BARB0SINGHP',
                'bank_pin' => '208017',
                'signatory_name' => 'Anil Mishra',
                'signatory_title' => 'Sales & Marketing, Refrigeration Division',
                'signatory_phone' => '9412452844',
                'ref_prefix' => 'UPR/A',
                'ref_year_mode' => 'fiscal',
                'default_gst_percent' => 18,
                'default_validity_days' => 60,
                'default_payment_terms' => "30% advance along with the purchase order; 69% against running bills; 1% balance against completion of job.",
                'default_delivery_terms' => "2-5 weeks ex-factory, delivery commitment from date of receipt of advance payment. 3 months for installation & commissioning at site subject to site clearance.",
                'default_warranty_terms' => "Warranty on refrigeration equipment is manufacturer's specific and will be honoured by the manufacturer as per their warranty terms. We stand warranty only for our quality workmanship & optimised plant design for 12 months from date of commissioning or 18 months from date of shipment, whichever expires sooner.",
                'default_freight' => 'F.O.R Site',
                'default_jurisdiction' => 'Kanpur',
                'default_cover_letter' => "We congratulate you on your venture and are pleased to submit our techno-commercial offer for the above. We assure you that we will do our best to make this project an ideal one and come up to your expectations. Our refrigeration systems & equipment are designed to give optimum performance and quality workmanship with the best possible energy savings over a longer operating period.",
                'is_active' => true,
            ],
        ];

        foreach ($profiles as $data) {
            CompanyProfile::updateOrCreate(['code' => $data['code']], $data);
        }
    }
}
