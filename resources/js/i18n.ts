import { createI18n } from "vue-i18n";
import enTranslation from "./locales/en.json";
import frTranslation from "./locales/fr.json";

enum LOCALE {
    FR = "fr",
    EN = "en",
}

const getBrowserDefaultLang = (): string => {
    if (navigator.languages !== undefined) {
        return navigator.languages[0].slice(0, 2);
    }
    return navigator.language.slice(0, 2);
};

const getRouteLang = (): string | null => {
    const path = window.location.pathname;
    const pathArray = path.split("/");
    const lang = pathArray[1];
    if (lang === LOCALE.FR || lang === LOCALE.EN) {
        return lang;
    }
    return null;
};

const getDefaultLang = (): string => {
    const selectedLang = getRouteLang();
    if (selectedLang) {
        return selectedLang;
    }
    const browserDefaultLang: string = getBrowserDefaultLang();
    return browserDefaultLang === LOCALE.FR || browserDefaultLang === LOCALE.EN
        ? browserDefaultLang
        : LOCALE.EN;
};

const setLangCookie = (lang: string) => {
    document.cookie = `locale=${lang}; path=/`;
};

export const setLang = (lang: string): void => {
    document.documentElement.lang = lang;
    setLangCookie(lang);
};

const datetimeFormats = {
    en: {
        short: {
            year: "numeric",
            month: "short",
            day: "numeric",
        },
        long: {
            year: "numeric",
            month: "short",
            day: "numeric",
            weekday: "short",
            hour: "numeric",
            minute: "numeric",
        },
        day: {
            weekday: "long",
        },
        dateMonth: {
            month: "short",
            day: "numeric",
        },
        time: {
            hour: "numeric",
            minute: "numeric",
        },
    },
    fr: {
        short: {
            year: "numeric",
            month: "short",
            day: "numeric",
        },
        long: {
            year: "numeric",
            month: "short",
            day: "numeric",
            weekday: "short",
            hour: "numeric",
            minute: "numeric",
        },
        day: {
            weekday: "long",
        },
        dateMonth: {
            month: "short",
            day: "numeric",
        },
        time: {
            hour: "numeric",
            minute: "numeric",
        },
    },
};

const numberFormats = {
    en: {
        currency: {
            style: "currency",
            currency: "EUR",
        },
    },
    fr: {
        currency: {
            style: "currency",
            currency: "EUR",
        },
    },
};

setLang(getDefaultLang());

const i18n = createI18n<false>({
    legacy: false,
    locale: getDefaultLang(),
    fallbackLocale: LOCALE.FR,
    globalInjection: true,
    messages: {
        fr: frTranslation,
        en: enTranslation,
    },
    datetimeFormats: datetimeFormats as any,
    numberFormats,
});

export default i18n;
