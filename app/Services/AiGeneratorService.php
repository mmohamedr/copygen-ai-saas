<?php

namespace App\Services;

use App\Contracts\AiGeneratorInterface;

class AiGeneratorService implements AiGeneratorInterface
{
    public function generate(array $data): string
    {
        // Simulate real API latency
        sleep(2);

        $locale      = app()->getLocale();
        $productName = $data['product_name'] ?? 'Your Product';
        $description = $data['description'] ?? null;
        $audience    = $data['audience'] ?? ($locale === 'ar' ? 'الجميع' : 'everyone');
        $tone        = $data['tone'] ?? 'professional';
        $contentType = $data['content_type'] ?? 'Ads';

        // ── English Templates ──────────────────────────────────────────────────
        $templatesEn = [
            'Ads' => [
                'professional' => "Discover :productName:. Modern solutions for today's challenges. :desc: Designed specifically for :audience:. Upgrade your workflow today.",
                'casual'       => "Hey there! Check out :productName: — it's awesome! :desc: Perfect for :audience:. Give it a try!",
                'persuasive'   => "Don't miss out on :productName:! The ultimate tool you need. :desc: Tailored for :audience:. Get yours now and see the difference!",
            ],
            'Product Description' => [
                'professional' => "The :productName: offers industry-leading features. :desc: Built with :audience: in mind, ensuring top-tier performance.",
                'casual'       => "This is the :productName: — really cool and does exactly what you need. :desc: If you're into :audience:, this is for you.",
                'persuasive'   => "Transform your life with :productName:. :desc: Whether you are :audience: or just starting out, this is a game-changer.",
            ],
            'Social Media Caption' => [
                'professional' => "Introducing our latest innovation: :productName:. Elevating standards for :audience:. :desc: #Innovation #Business",
                'casual'       => "So excited about :productName:! 🚀 :desc: If you're a :audience:, you'll absolutely love this. 💯",
                'persuasive'   => "Ready to level up? 🌟 :productName: is here to help! :desc: Perfect for :audience:. Click the link in bio! 🔥",
            ],
        ];

        // ── Arabic Templates ───────────────────────────────────────────────────
        $templatesAr = [
            'Ads' => [
                'professional' => "اكتشف :productName: — حلول متطورة تلبي احتياجات اليوم. :desc: مصمم خصيصاً لـ :audience:. طوّر أسلوب عملك الآن.",
                'casual'       => "مرحباً! جرّب :productName: — رائع بكل المقاييس! :desc: مثالي لـ :audience:. لا تفوّت الفرصة!",
                'persuasive'   => "لا تفوّت :productName:! إنه الأداة المثالية التي تحتاجها. :desc: مصمم لـ :audience:. احصل عليه الآن وشاهد الفرق بنفسك!",
            ],
            'Product Description' => [
                'professional' => "يوفر :productName: ميزات رائدة في المجال. :desc: مبني مع مراعاة احتياجات :audience:، لضمان أعلى مستويات الأداء.",
                'casual'       => ":productName: منتج رائع ويؤدي ما تحتاجه بدقة. :desc: إن كنت من فئة :audience:، هذا المنتج مصنوع لك.",
                'persuasive'   => "غيّر حياتك مع :productName:. :desc: سواء كنت من :audience: أو بدأت للتو، ستجد فيه الفرق الحقيقي.",
            ],
            'Social Media Caption' => [
                'professional' => "نقدم لكم أحدث ابتكاراتنا: :productName:. نرفع المعايير لـ :audience:. :desc: #ابتكار #أعمال",
                'casual'       => "متحمسون جداً لـ :productName:! 🚀 :desc: إن كنت من فئة :audience: ستحب هذا بالتأكيد. 💯",
                'persuasive'   => "مستعد للارتقاء؟ 🌟 :productName: هنا ليساعدك! :desc: مثالي لـ :audience:. لا تتردد! 🔥",
            ],
        ];

        $templates = ($locale === 'ar') ? $templatesAr : $templatesEn;

        $defaultEn = "Here is AI-generated content for :productName:. :desc: Created for :audience:.";
        $defaultAr = "إليك محتوى مُنشأ بالذكاء الاصطناعي لـ :productName:. :desc: مخصص لـ :audience:.";
        $default   = ($locale === 'ar') ? $defaultAr : $defaultEn;

        $template = $templates[$contentType][$tone] ?? $default;

        $descText = $description
            ? ($locale === 'ar' ? "يتميز بـ {$description}." : "Featuring {$description}.")
            : "";

        $content = str_replace(
            [':productName:', ':desc:', ':audience:'],
            [$productName, $descText, $audience],
            $template
        );

        return trim(preg_replace('/\s+/', ' ', $content));
    }
}
