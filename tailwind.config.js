import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './app/View/Components/**/*.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
            },

            colors: {
                ink: {
                    950: '#0B0F14',
                    700: '#2A3340',
                    500: '#5A6573',
                },
                line: '#E5E7EB',
                surface: '#FAFAF7',
                card: '#FFFFFF',
                elevated: '#F5F5F1',

                brand: {
                    50: '#ECF3EF',
                    500: '#2A6650',
                    600: '#1F4D3A',
                },
                accent: {
                    50: '#FFF3EC',
                    600: '#C2410C',
                },

                success: '#16A34A',
                warn: '#D97706',
                danger: '#B91C1C',
            },

            spacing: {
                '4.5': '1.125rem',
                '18': '4.5rem',
                'safe-bottom': 'env(safe-area-inset-bottom)',
            },

            borderRadius: {
                'sm': '6px',
                'md': '10px',
                'lg': '14px',
                'xl': '20px',
            },

            boxShadow: {
                'soft-1': '0 1px 2px rgba(11,15,20,0.04), 0 1px 1px rgba(11,15,20,0.03)',
                'soft-2': '0 8px 24px -8px rgba(11,15,20,0.10), 0 2px 6px rgba(11,15,20,0.04)',
                'ring-brand': '0 0 0 3px rgba(31,77,58,0.25)',
            },

            transitionTimingFunction: {
                'out-soft': 'cubic-bezier(0.22, 1, 0.36, 1)',
            },

            transitionDuration: {
                '120': '120ms',
            },

            screens: {
                'xs': '480px',
            },
        },
    },

    plugins: [forms],
};
