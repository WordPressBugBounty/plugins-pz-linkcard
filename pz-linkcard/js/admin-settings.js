document.addEventListener("DOMContentLoaded", () => {

	const dashboard = document.querySelector(".pz-dashboard");
    if (!dashboard) return;

	// 処理中オーバーレイを非表示
    document.querySelector("#pz-overlay-proc")?.style.setProperty("display", "none");

	// WordPress 標準のカラーピッカー (wpColorPicker) は jQuery 依存なので注意！
    document.querySelectorAll(".pz-wp-color-picker").forEach(el => {
        if (typeof jQuery !== "undefined" && typeof jQuery(el).wpColorPicker === "function") {
            jQuery(el).wpColorPicker();
        }
    });

	// スクロール位置の調整
    const scrollNow = document.querySelector("input[name='scroll-now']");
    const cacheEditor = document.querySelector(".pz-man-cache-editor");
    if (scrollNow && !cacheEditor) window.scrollTo(0, scrollNow.value);

    window.addEventListener("load", () => {
        document.querySelector("#pz-overlay-proc")?.classList.add("hidden");

        switchEnabled();

        // 一番上に行くボタン
        document.querySelectorAll(".pz-button-top").forEach(btn =>
            btn.addEventListener("click", buttonTopClick)
        );
        window.addEventListener("scroll", topButtonScroll);

        // ショートコードをコピー
        document.querySelectorAll(".pz-shortcode-1").forEach(el =>
            el.addEventListener("keyup", copyShortcode)
        );

        // ショートコードの入力チェック
        ["code1","code2","code3","code4"].forEach(code => {
            const el = document.querySelector(`input[name="properties[${code}]"]`);
            if (el) el.addEventListener("keydown", checkShortcodeKey);
        });

        // すべてのWP-Cronスケジュールを表示
        document.querySelectorAll(".pz-cron-all").forEach(el =>
            el.addEventListener("change", showAllCron)
        );

        // submit時にスクロール位置保存
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", () => {
                if (scrollNow && !cacheEditor) scrollNow.value = window.scrollY;
                const inhibit = document.querySelector("input[name='properties[flg-inhibit]']");
                if (inhibit?.checked) {
                    const overlay = document.querySelector("#pz-overlay-proc");
                    if (overlay) {
                        overlay.classList.remove("hidden");
                        overlay.style.display = "block";
                    }
                }
            });
        });

        // クリックで全選択
        document.querySelectorAll(".pz-click-all-select").forEach(el =>
            el.addEventListener("click", allSelect)
        );

        // readonly チェックボックス無効化
        document.querySelectorAll("input[type=checkbox]").forEach(el =>
            el.addEventListener("click", checkboxReadonly)
        );

        // 自動変換チェック
        document.querySelectorAll(".pz-sync-check,.pz-show").forEach(el =>
            el.addEventListener("change", switchEnabled)
        );

        document.querySelector("#pz-overlay-proc")?.classList.add("hidden");
    });

    // ----------- 関数群 -----------

    // 一番上へ行く
    function buttonTopClick(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
    }

    // TOPボタンの表示切替
    function topButtonScroll() {
        const btn = document.querySelector(".pz-button-top");
        if (!btn) return;
        if (window.scrollY > 80) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    }

    // 項目の有効化／無効化
    function switchEnabled() {
        const setDisabled = (selector, disabled, readonly=false, color=null) => {
            document.querySelectorAll(selector).forEach(el => {
                el.disabled = disabled;
                el.readOnly = readonly;
                if (color !== null) {
                    el.parentElement.style.color = color;
                    el.style.color = color;
                }
            });
        };

        // カスタムフィールド
        const inGet = document.querySelector("select[name='properties[in-get]']")?.value;
        setDisabled("input[name='properties[in-field-title]']", inGet != "3");
        setDisabled("input[name='properties[in-field-excerpt]']", inGet != "3");

        // サムネイル（外部）
        const exThumb = document.querySelector("select[name='properties[ex-thumbnail]']")?.value;
        setDisabled("select[name='properties[ex-thumbnail-size]']", !(exThumb == "1" || exThumb == "13"));

        // サムネイル（内部）
        const inThumb = document.querySelector("select[name='properties[in-thumbnail]']")?.value;
        setDisabled("select[name='properties[in-thumbnail-size]']", !(inThumb == "1" || inThumb == "13"));

        // ユーザーエージェント
        const flgAgentEl = document.querySelector("input[name='properties[flg-agent]'][type=checkbox]");
		const flgAgent = flgAgentEl ? flgAgentEl.checked : false;
		setDisabled("input[name='properties[user-agent]']", !flgAgent, !flgAgent );

		// 自動変換関連
		const autoAtagEl = document.querySelector("input[name='properties[auto-atag]'][type=checkbox]");
		const autoUrlEl  = document.querySelector("input[name='properties[auto-url]'][type=checkbox]");
		const autoAtag = autoAtagEl ? autoAtagEl.checked : false;
		const autoUrl = autoUrlEl ? autoUrlEl.checked : false;
		const enabled = autoAtag || autoUrl;
		setDisabled("input[name='properties[auto-external]'][type=checkbox]", false, !enabled, enabled ? "#444" : "#ddd");
		setDisabled("input[name='properties[flg-do-shortcode]'][type=checkbox]", false, !enabled, enabled ? "#444" : "#ddd");
		setDisabled("textarea[name='properties[exclude-url]']", false, !enabled, enabled ? "#444" : "#888");
	}

    // ショートコードをコピー
    function copyShortcode(e) {
        const val = e.target.value;
        document.querySelectorAll(".pz-shortcode-copy").forEach(el => {
            el.textContent = val;
        });
        document.querySelectorAll(".pz-shortcode-enabled").forEach(el => {
            el.disabled = val.length === 0;
        });
    }

    // ショートコード入力チェック
    function checkShortcodeKey(e) {
        if (e.key === " ") {
            e.preventDefault();
        }
    }

    // WP-Cron 一覧の表示切替
    function showAllCron(e) {
        document.querySelectorAll(".pz-cron-list-other").forEach(el => {
            if (e.target.checked) {
                el.style.display = "table-row";
                el.classList.add("pz-show");
                el.classList.remove("pz-hide");
            } else {
                el.style.display = "none";
                el.classList.remove("pz-show");
                el.classList.add("pz-hide");
            }
        });
    }

    // カラーピッカーとテキスト同期
    function syncColor(e) {
        const name = e.target.getAttribute("name");
        const value = e.target.value;
        document.querySelectorAll(`input[name="${name}"]`).forEach(el => {
            el.value = value;
        });
    }

    // readonly チェックボックス無効化
    function checkboxReadonly(e) {
        if (e.target.readOnly) {
            e.preventDefault();
        }
    }

    // 全選択
    function allSelect(e) {
        const el = e.target;
        if (el.tagName === "INPUT") {
            el.select();
        } else if (el.tagName === "DIV") {
            const range = document.createRange();
            range.selectNodeContents(el);
            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        }
    }
});
