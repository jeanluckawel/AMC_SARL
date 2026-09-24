<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {

            $table->id();

            // 1. Identification du Travailleur (Code du Travail RDC)
            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // 2. Période de paie
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');

            // 3. Salaire de base et temps de travail
            $table->decimal('days_worked', 4, 1)->default(26.0); // Généralement 26 jours ouvrables par mois en RDC
            $table->decimal('basic_salary', 15, 2)->default(0);

            // 4. Primes et Heures Supplémentaires (Soumises à cotisations et impôts)
            $table->decimal('overtime_hours', 8, 2)->default(0);
            $table->decimal('overtime_amount', 15, 2)->default(0); // Majorations légales de 15%, 50%, 100%
            $table->decimal('bonus', 15, 2)->default(0);            // Primes de performance, d'ancienneté, de fin d'année
            $table->decimal('other_taxable_allowances', 15, 2)->default(0); // Autres primes soumises (ex: prime de risque)

            // 5. Allocations et Indemnités Exonérées (Sous plafonds légaux en RDC)
            $table->decimal('housing_allowance', 15, 2)->default(0); // Indemnité de logement (Exonérée si < 30% du salaire de base)
            $table->decimal('transport_allowance', 15, 2)->default(0); // Indemnité de transport (Légale ou conventionnelle exonérée)
            $table->decimal('meal_allowance', 15, 2)->default(0);      // Collation / Restauration
            $table->decimal('family_allowance', 15, 2)->default(0);    // Allocations familiales (Exonérées sous plafond de l'INSS/CNSS)
            $table->decimal('medical_allowance', 15, 2)->default(0);   // Prise en charge des soins médicaux exonérée
            $table->decimal('other_non_taxable_allowances', 15, 2)->default(0);

            // 6. Totaux intermédiaires (Bases de calcul fiscaux et sociaux)
            $table->decimal('gross_salary', 15, 2)->default(0);        // Salaire Brut Total (Gains globaux)
            $table->decimal('social_base', 15, 2)->default(0);         // Base de calcul CNSS (Plafonnée selon la loi en vigueur)
            $table->decimal('fiscal_base', 15, 2)->default(0);         // Base imposable pour l'IPR (Brut imposable)

            // 7. Retenues à la charge du Travailleur (Retenues sur salaire)
            $table->decimal('cnss_employee', 15, 2)->default(0);      // CNSS Ouvrière : Part salarié (5%)
            $table->decimal('ipr', 15, 2)->default(0);                // Impôt Professionnel sur les Rémunérations (Barème progressif DGI)
            $table->decimal('salary_advances', 15, 2)->default(0);   // Avances sur salaire / Acomptes de quinzaine
            $table->decimal('syndicate_deduction', 15, 2)->default(0); // Cotisation syndicale (retenue à la source si applicable)
            $table->decimal('other_deductions', 15, 2)->default(0);   // Prêts internes ou autres retenues diverses

            // 8. Charges Patronales en RDC (Cotisations à charge exclusive de l'employeur - Non déduites du Net)
            $table->decimal('cnss_employer', 15, 2)->default(0);      // CNSS Patronale : Part employeur (13% au régime général)
            $table->decimal('inpp_employer', 15, 2)->default(0);      // INPP : Institut National de Préparation Professionnelle (1%, 2% ou 3% selon la taille de l'entreprise)
            $table->decimal('onem_employer', 15, 2)->default(0);      // ONEM : Office National de l'Emploi (0,2% de la masse de rémunération brute)

            // 9. Impôt sur les Expatriés (Si applicable)
            $table->decimal('ier', 15, 2)->default(0);                // IER : Impôt Exonéré sur les Rémunérations des Expatriés (Taux standard 10% ou 25%)

            // 10. Totaux finaux
            $table->decimal('total_deductions', 15, 2)->default(0);   // Somme des retenues du salarié (cnss_employee + ipr + advances + syndicate + other_deductions)
            $table->decimal('net_salary', 15, 2)->default(0);         // Le Net à Payer final au travailleur

            // 11. Devise et Règlement (Courant d'avoir CDF ou USD)
            $table->string('currency', 3)->default('CDF');             // CDF ou USD
            $table->date('payment_date')->nullable();
            $table->string('payment_method')->default('bank_transfer'); // bank_transfer, cash, cheque
            $table->string('payment_reference')->nullable();           // Référence bancaire (Rawbank, EquityBCDC, TMB, etc.)

            // 12. Commentaires et traçabilité
            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
