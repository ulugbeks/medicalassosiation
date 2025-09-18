<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'title' => 'Biochemistry Solution',
                'description' => 'Solutions are involved in various metabolic pathways, like glycolysis, where glucose is converted to pyruvate.',
                'content' => '<p>Our Biochemistry Solutions department offers comprehensive services for analyzing biological samples and providing insights into metabolic processes and cellular functions. We specialize in identifying and quantifying biomolecules, studying enzymatic reactions, and investigating biochemical pathways crucial for understanding health and disease.</p><h3>Our Services Include:</h3><ul><li>Comprehensive metabolic profiling</li><li>Enzyme activity assays</li><li>Protein quantification and characterization</li><li>Biomarker discovery and validation</li><li>Metabolic pathway analysis</li><li>Toxicological assessments</li><li>Clinical biochemistry testing</li></ul><p>Our state-of-the-art laboratory is equipped with advanced instrumentation for precise, reliable, and timely biochemical analyses. Our team of expert biochemists and technicians ensures accurate results and insightful interpretations to support research, clinical diagnostics, pharmaceutical development, and industrial applications.</p><h3>Applications:</h3><p>Our biochemistry solutions are vital for medical diagnostics, pharmaceutical research, academic studies, and biotechnology innovation. From routine clinical tests to cutting-edge research investigations, our services provide essential biochemical data for informed decision-making and scientific advancement.</p><p>We pride ourselves on customizing our approach to meet the specific needs of each client, whether it\'s developing a novel assay method, optimizing an existing protocol, or scaling up for high-throughput applications.</p>',
                'image' => 'images/service/01.jpg',
                'icon' => 'flaticon flaticon-biochemistry',
                'order' => 1,
                'active' => 1,
            ],
            [
                'title' => 'Pharmaceutical Research',
                'description' => 'We use cutting-edge technologies and scientific advancements to identify and develop new drug candidates.',
                'content' => '<p>Our Pharmaceutical Research division is dedicated to advancing drug discovery and development through innovative approaches and rigorous scientific methodologies. We collaborate with pharmaceutical companies, academic institutions, and research organizations to identify, develop, and optimize novel therapeutic agents.</p><h3>Our Services Include:</h3><ul><li>Drug target identification and validation</li><li>High-throughput screening of compound libraries</li><li>Lead optimization and medicinal chemistry</li><li>In vitro and in vivo pharmacology studies</li><li>ADME (Absorption, Distribution, Metabolism, Excretion) profiling</li><li>Toxicology assessments</li><li>Formulation development</li><li>Analytical method development and validation</li></ul><p>Our multidisciplinary team combines expertise in biology, chemistry, pharmacology, and data science to address complex challenges in drug discovery. We utilize advanced technologies including computational modeling, automated screening platforms, and sophisticated analytical instruments to accelerate and enhance the research process.</p><h3>Our Approach:</h3><p>We employ a translational research approach that bridges the gap between basic science and clinical applications. Our iterative process involves constant refinement based on experimental data and emerging insights. We prioritize mechanism-based drug discovery, seeking to understand the molecular basis of diseases and design targeted interventions.</p><p>Our pharmaceutical research services are tailored to support projects at various stages of development, from early discovery to preclinical testing. We offer flexible engagement models to accommodate the unique needs of each research program, whether it\'s a focused service or an end-to-end solution.</p>',
                'image' => 'images/service/02.jpg',
                'icon' => 'flaticon flaticon-chemistry-4',
                'order' => 2,
                'active' => 1,
            ],
            [
                'title' => 'Pathologycam Testing',
                'description' => 'Pathologycam systems offer unparalleled image clarity, allowing for the detailed visualization of cellular structures.',
                'content' => '<p>Our Pathologycam Testing service represents a significant advancement in pathology diagnostics, utilizing state-of-the-art digital imaging technology to enhance the accuracy, efficiency, and accessibility of pathological examinations. This innovative approach transforms traditional microscopy into a dynamic digital platform for improved diagnostic capabilities and collaborative analysis.</p><h3>Our Services Include:</h3><ul><li>High-resolution whole slide imaging (WSI)</li><li>Digital pathology consultations and second opinions</li><li>Quantitative image analysis</li><li>Artificial intelligence-assisted diagnostics</li><li>Remote pathology services</li><li>Digital archiving and retrieval of pathology images</li><li>Educational and research applications</li></ul><p>Our Pathologycam system captures microscopic slides at exceptionally high resolution, creating digital replicas that can be viewed, analyzed, and shared through secure digital platforms. This technology eliminates the limitations of traditional microscopy, allowing pathologists to examine specimens remotely, collaborate with colleagues worldwide, and employ computational tools for enhanced analysis.</p><h3>Clinical Applications:</h3><p>Pathologycam Testing is invaluable for diagnosing various conditions, including cancer, inflammatory diseases, infectious processes, and degenerative disorders. The digital format facilitates precise measurements, annotations, and side-by-side comparisons, contributing to more accurate and consistent diagnoses.</p><p>The integration of artificial intelligence algorithms further augments the diagnostic process by highlighting regions of interest, suggesting potential diagnoses, and assisting in the quantification of biomarkers. This synergy between expert pathologists and advanced technology elevates the standard of pathological examinations.</p>',
                'image' => 'images/service/03.jpg',
                'icon' => 'flaticon flaticon-test',
                'order' => 3,
                'active' => 1,
            ],
            [
                'title' => 'Chemical Research',
                'description' => 'Chemical research labs are used to conduct research and development in the field of chemistry, including studying chemical reactions.',
                'content' => '<p>Our Chemical Research division is dedicated to exploring the fundamental principles of chemistry and applying these insights to develop innovative solutions for complex challenges. We conduct rigorous investigations across various chemical disciplines, employing advanced methodologies and instrumentation to push the boundaries of scientific knowledge and practical applications.</p><h3>Our Research Areas Include:</h3><ul><li>Synthetic organic and inorganic chemistry</li><li>Analytical chemistry and method development</li><li>Materials science and characterization</li><li>Catalysis and reaction mechanisms</li><li>Green chemistry and sustainable processes</li><li>Computational chemistry and molecular modeling</li><li>Surface chemistry and interfacial phenomena</li></ul><p>Our state-of-the-art laboratories are equipped with cutting-edge instrumentation for comprehensive chemical analysis, synthesis, and characterization. This includes advanced spectroscopic techniques (NMR, mass spectrometry, IR, UV-Vis), chromatography systems, thermal analysis tools, and computational resources for molecular simulations.</p><h3>Applications and Impact:</h3><p>Our chemical research has far-reaching implications across multiple sectors, including pharmaceuticals, materials development, environmental protection, energy production, and industrial manufacturing. We translate fundamental chemical principles into practical solutions that address real-world challenges and create new opportunities for innovation.</p><p>We collaborate with industry partners, academic institutions, and government agencies on research projects ranging from targeted problem-solving to exploratory investigations. Our flexible research models accommodate various project scopes, from short-term analytical studies to comprehensive multi-year research programs.</p>',
                'image' => 'images/service/04.jpg',
                'icon' => 'flaticon flaticon-biochemistry-1',
                'order' => 4,
                'active' => 1,
            ],
            [
                'title' => 'Diagnostic Testing',
                'description' => 'There are many different types of diagnostic tests, including laboratory tests (blood and urine tests), imaging tests (mammography, CT scans), endoscopy (colonoscopy, bronchoscopy), and biopsy.',
                'content' => '<p>Our Diagnostic Testing services offer comprehensive clinical laboratory examinations to aid in the detection, diagnosis, and monitoring of health conditions. We provide accurate, timely, and clinically relevant test results to support healthcare providers in making informed medical decisions for optimal patient care.</p><h3>Our Testing Categories Include:</h3><ul><li>Clinical Chemistry: Assessments of blood glucose, electrolytes, lipids, proteins, and organ function markers</li><li>Hematology: Complete blood counts, coagulation studies, and blood cell morphology</li><li>Immunology: Antibody detection, immunoglobulin levels, and autoimmune markers</li><li>Microbiology: Bacterial, viral, fungal, and parasitic identification and sensitivity testing</li><li>Molecular Diagnostics: DNA/RNA-based testing for genetic disorders and infectious diseases</li><li>Toxicology: Drug screening, therapeutic drug monitoring, and toxin detection</li><li>Special Chemistry: Hormone assays, tumor markers, and specialized metabolic tests</li></ul><p>Our laboratory employs advanced analytical instrumentation and validated methodologies to ensure the highest quality results. Our stringent quality control processes and participation in proficiency testing programs guarantee the reliability of our diagnostic services.</p><h3>Service Features:</h3><p>We offer flexible testing options including routine, STAT (urgent), and specialized tests to meet diverse clinical needs. Our user-friendly electronic reporting system provides secure, timely access to test results with interpretive comments where appropriate. Our experienced laboratory professionals are available for consultation on test selection, result interpretation, and clinical implications.</p><p>We continuously update our test menu to incorporate evidence-based advances in laboratory medicine, ensuring that healthcare providers have access to clinically valuable diagnostic information to guide patient management.</p>',
                'image' => 'images/service/05.jpg',
                'icon' => 'flaticon flaticon-chemistry-2',
                'order' => 5,
                'active' => 1,
            ],
            [
                'title' => 'Diabetes Testing',
                'description' => 'The goal of naturopathic medicine is to treat the whole person -- that means mind, body, and spirit. It also aims to heal the root causes of an illness -- not just stop the symptoms.',
                'content' => '<p>Our Diabetes Testing service provides comprehensive evaluation of glucose metabolism to aid in the screening, diagnosis, and management of diabetes mellitus. We offer a range of tests that assess blood glucose levels, long-term glycemic control, and related metabolic parameters to support effective diabetes care and prevention strategies.</p><h3>Our Testing Services Include:</h3><ul><li>Fasting Plasma Glucose (FPG): Measurement of blood glucose levels after an overnight fast</li><li>Oral Glucose Tolerance Test (OGTT): Assessment of glucose metabolism in response to a glucose challenge</li><li>Hemoglobin A1c (HbA1c): Evaluation of average blood glucose levels over the past 2-3 months</li><li>Random Plasma Glucose: Blood glucose measurement at any time of day</li><li>Insulin Assays: Quantification of insulin levels to assess pancreatic function and insulin resistance</li><li>C-peptide Testing: Measurement of endogenous insulin production</li><li>Autoantibody Testing: Detection of antibodies associated with type 1 diabetes</li></ul><p>Our laboratory utilizes precise analytical methods and calibrated instruments to ensure accurate glucose and HbA1c measurements. We adhere to standardized protocols and participate in quality assurance programs specifically for diabetes-related testing.</p><h3>Clinical Applications:</h3><p>Our diabetes testing services support various clinical scenarios, including screening of asymptomatic individuals with risk factors, diagnostic evaluation of suspected diabetes, monitoring of glycemic control in patients with established diabetes, and assessment of diabetes-related complications.</p><p>We provide clear, interpretive reporting that includes reference ranges, clinical decision points based on current guidelines, and trending of results for patients with serial measurements. Our laboratory specialists are available for consultation on test selection, result interpretation, and clinical implications to optimize diabetes management.</p>',
                'image' => 'images/service/06.jpg',
                'icon' => 'flaticon flaticon-ph-meter',
                'order' => 6,
                'active' => 1,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}