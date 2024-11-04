<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }
    public function export_excel() {
        $details = $this->session->userdata('user_detail_list'); 

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="registered_users.xls"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "ID\tName\tEmail\tAddress\tPhone\tDesignation\tCreated At\n";
        foreach ($details as $user) {
            echo "{$user->id}\t{$user->name}\t{$user->email}\t{$user->address}\t{$user->phone}\t{$user->designation}\t{$user->created_date_time}\n";
        }
    }
    public function export_pdf() {
        $details = $this->session->userdata('user_detail_list'); 
        $this->load->library('fpdf');
    
        $pdf = new FPDF();
        $pdf->AddPage();
    
        // Set the font for the heading
        $pdf->SetFont('Arial', 'B', 12); // Heading font size
        $pdf->Cell(0, 10, 'Users List', 0, 1, 'C'); // Centered heading
        $pdf->Ln(5); // Add some space after the heading
    
        // Set the font for the table
        $pdf->SetFont('Arial', 'B', 9); // Change font size to 9
    
        // Table headers
        $pdf->Cell(10, 10, 'ID', 1);
        $pdf->Cell(15, 10, 'Name', 1);
        $pdf->Cell(25, 10, 'Email', 1);
        $pdf->Cell(30, 10, 'Address', 1);
        $pdf->Cell(25, 10, 'Phone', 1);
        $pdf->Cell(30, 10, 'Designation', 1);
        $pdf->Cell(40, 10, 'Created At', 1);
        $pdf->Ln();
    
        // Set font for data rows
        $pdf->SetFont('Arial', '', 9); // Change font size to 9 for data
    
        foreach ($details as $user) {
            $pdf->Cell(10, 10, $user->id, 1);
            $pdf->Cell(15, 10, $user->name, 1);
            $pdf->Cell(25, 10, $user->email, 1);
            $pdf->Cell(30, 10, $user->address, 1);
            $pdf->Cell(25, 10, $user->phone, 1);
            $pdf->Cell(30, 10, $user->designation, 1);
            $pdf->Cell(40, 10, $user->created_date_time, 1);
            $pdf->Ln();
        }
    
        $pdf->Output('D', 'registered_users.pdf');
    }
    
    
}
