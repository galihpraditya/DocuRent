<!-- Universal Quiet Luxury Confirmation Modal -->
<div id="custom-confirm-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-zinc-950/60 backdrop-blur-xs transition-opacity duration-200">
    <div class="relative w-full max-w-md bg-white rounded-3xl border border-zinc-200/80 shadow-2xl p-6 sm:p-7 overflow-hidden transform transition-all">
        
        <!-- Top Icon & Close Button -->
        <div class="flex items-start justify-between">
            <!-- Danger Icon (Default) -->
            <div id="confirm-modal-icon-danger" class="w-11 h-11 rounded-2xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center shadow-2xs">
                <i class="ti ti-trash text-xl"></i>
            </div>
            <!-- Warning / Info Icon -->
            <div id="confirm-modal-icon-warning" class="w-11 h-11 rounded-2xl bg-zinc-100 text-zinc-800 border border-zinc-200 flex items-center justify-center shadow-2xs hidden">
                <i class="ti ti-refresh text-xl"></i>
            </div>

            <button 
                type="button" 
                onclick="closeConfirmModal()"
                class="w-8 h-8 rounded-full bg-zinc-100 text-zinc-400 hover:text-zinc-900 hover:bg-zinc-200 flex items-center justify-center transition-colors cursor-pointer"
                aria-label="Tutup"
            >
                <i class="ti ti-x text-sm"></i>
            </button>
        </div>

        <!-- Title & Description -->
        <div class="mt-4">
            <h3 id="confirm-modal-title" class="text-base font-bold text-zinc-900 tracking-tight leading-snug">
                Konfirmasi Tindakan
            </h3>
            <p id="confirm-modal-message" class="text-xs text-zinc-500 leading-relaxed font-normal mt-1.5">
                Apakah Anda yakin ingin melanjutkan tindakan ini?
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex items-center gap-3">
            <button 
                type="button" 
                onclick="closeConfirmModal()"
                class="px-4 py-2.5 rounded-xl border border-zinc-200/90 bg-white hover:bg-zinc-50 text-zinc-700 font-semibold text-xs transition-all flex-1 cursor-pointer text-center"
            >
                Batal
            </button>
            <button 
                type="button" 
                id="confirm-modal-btn"
                onclick="executeConfirmAction()"
                class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs transition-all shadow-2xs flex-1 cursor-pointer text-center"
            >
                Konfirmasi
            </button>
        </div>

    </div>
</div>

<script>
    window.activeConfirmCallback = null;

    function openConfirmModal(options) {
        const modal = document.getElementById('custom-confirm-modal');
        const titleEl = document.getElementById('confirm-modal-title');
        const msgEl = document.getElementById('confirm-modal-message');
        const btnEl = document.getElementById('confirm-modal-btn');
        const iconDanger = document.getElementById('confirm-modal-icon-danger');
        const iconWarning = document.getElementById('confirm-modal-icon-warning');

        if (!modal) return;

        titleEl.textContent = options.title || 'Konfirmasi Tindakan';
        msgEl.innerHTML = options.message || 'Apakah Anda yakin ingin melanjutkan tindakan ini?';
        btnEl.textContent = options.confirmText || 'Konfirmasi';

        const isDanger = options.isDanger !== false;
        if (isDanger) {
            btnEl.className = 'px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs transition-all shadow-2xs flex-1 cursor-pointer text-center';
            if (iconDanger) iconDanger.classList.remove('hidden');
            if (iconWarning) iconWarning.classList.add('hidden');
        } else {
            btnEl.className = 'px-4 py-2.5 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-white font-semibold text-xs transition-all shadow-2xs flex-1 cursor-pointer text-center';
            if (iconDanger) iconDanger.classList.add('hidden');
            if (iconWarning) iconWarning.classList.remove('hidden');
        }

        window.activeConfirmCallback = options.onConfirm || null;
        modal.classList.remove('hidden');
    }

    function closeConfirmModal() {
        const modal = document.getElementById('custom-confirm-modal');
        if (modal) modal.classList.add('hidden');
        window.activeConfirmCallback = null;
    }

    function executeConfirmAction() {
        if (typeof window.activeConfirmCallback === 'function') {
            const cb = window.activeConfirmCallback;
            closeConfirmModal();
            cb();
        } else {
            closeConfirmModal();
        }
    }

    // Close on backdrop click
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('custom-confirm-modal');
        if (modal && !modal.classList.contains('hidden')) {
            if (e.target === modal) {
                closeConfirmModal();
            }
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeConfirmModal();
        }
    });
</script>
