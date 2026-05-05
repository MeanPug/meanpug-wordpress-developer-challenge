<?php
/**
 * Template Part: Contact Section
 * Harkness Style
 */

$form_id = 'YOUR_FORM_ID'; // We'll try to fetch it dynamically if possible
?>

<section id="contact" class="py-32 px-6 bg-[#0b1120] text-white">
    <div class="max-w-[1200px] mx-auto">
        <div class="text-center mb-24">
            <h2 class="text-white text-5xl md:text-7xl mb-6">The Fee is Free.</h2>
            <p class="text-gray-400 font-medium max-w-2xl mx-auto leading-relaxed">
                We fight for your rights with zero upfront costs. You only pay if we win your case.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-24 items-start">
            <!-- Left Info -->
            <div class="lg:w-5/12 space-y-16">
                <div class="flex items-center gap-8 group">
                    <div class="w-16 h-16 rounded-full border border-white/10 flex items-center justify-center group-hover:border-[#d4af37] transition-colors">
                        <svg class="w-6 h-6 text-[#d4af37]" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                    </div>
                    <div>
                        <span class="block text-[10px] font-black uppercase tracking-widest text-white/40 mb-1">Contact Info</span>
                        <a href="tel:1-800-PUG-FIRM" class="text-2xl font-black hover:text-[#d4af37] transition-colors tracking-tight">1-800-PUG-FIRM</a>
                    </div>
                </div>

                <div class="flex items-center gap-8 group">
                    <div class="w-16 h-16 rounded-full border border-white/10 flex items-center justify-center group-hover:border-[#d4af37] transition-colors">
                        <svg class="w-6 h-6 text-[#d4af37]" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                    </div>
                    <div>
                        <span class="block text-[10px] font-black uppercase tracking-widest text-white/40 mb-1">Email</span>
                        <a href="mailto:hello@meanpug.com" class="text-2xl font-black hover:text-[#d4af37] transition-colors tracking-tight">hello@meanpug.com</a>
                    </div>
                </div>

                <div class="flex items-center gap-8 group">
                    <div class="w-16 h-16 rounded-full border border-white/10 flex items-center justify-center group-hover:border-[#d4af37] transition-colors">
                        <svg class="w-6 h-6 text-[#d4af37]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <span class="block text-[10px] font-black uppercase tracking-widest text-white/40 mb-1">Map</span>
                        <p class="text-2xl font-black tracking-tight">MeanPug HQ</p>
                    </div>
                </div>
            </div>

            <!-- Right Form -->
            <div class="lg:w-7/12 w-full">
                <div class="bg-white rounded-xl p-12 text-[#0b1120]">
                    <form class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <input type="text" placeholder="First Name" class="w-full bg-[#fcfcfc] border border-gray-100 p-5 rounded outline-none font-bold text-sm focus:border-[#d4af37]">
                            <input type="text" placeholder="Last Name" class="w-full bg-[#fcfcfc] border border-gray-100 p-5 rounded outline-none font-bold text-sm focus:border-[#d4af37]">
                        </div>
                        <input type="email" placeholder="Email" class="w-full bg-[#fcfcfc] border border-gray-100 p-5 rounded outline-none font-bold text-sm focus:border-[#d4af37]">
                        <input type="tel" placeholder="Phone" class="w-full bg-[#fcfcfc] border border-gray-100 p-5 rounded outline-none font-bold text-sm focus:border-[#d4af37]">
                        <textarea placeholder="Briefly describe your case" rows="4" class="w-full bg-[#fcfcfc] border border-gray-100 p-5 rounded outline-none font-bold text-sm focus:border-[#d4af37]"></textarea>
                        
                        <button type="button" class="w-full bg-[#0b1120] text-white font-black py-6 rounded hover:bg-[#d4af37] transition-all uppercase tracking-[0.3em] text-xs">
                            Submit My Case
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
