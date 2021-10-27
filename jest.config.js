module.exports = {
  preset: '@vue/cli-plugin-unit-jest',
  moduleNameMapper: {
    '^@/(.*)$': '<rootDir>/resources/$1',
  },
  testMatch: [
    '**/tests/js/**/*.spec.[jt]s?(x)',
    '**/__tests__/*.[jt]s?(x)',
  ],
};
