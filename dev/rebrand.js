const chalk = require("chalk");
const path = require("path");
const inquirer = require("inquirer");
const {pascalCase, paramCase, constantCase} = require("change-case");
const replace = require("replace-in-file");
const { log, error: logError } = console;

chalk.level = chalk.level === 0 ? 1 : chalk.level;

baseValues = {
    project_name: "PrototyPress Theme",
    project_description: "PrototyPress isn't just a starter theme. It is a powerful tool to speed up your development workflow.",
    namespace: "PrototyPressTheme",
    const_prefix: "PROTOTYPRESSTHEME",
    text_domain: "prototypress",
    author: "RBFraphael",
    author_url: "https://rbfraphael.github.io",
    git_repository: "https://github.com/rbfraphael/prototypress-theme",
};

inquirer.prompt([
    {
        type: "input",
        name: "project_name",
        message: `Project name ['${baseValues.project_name}']`,
        filter: (val) => val.trim(),
        validate: (val) => val.length !== 0
    },
    {
        type: "input",
        name: "project_description",
        message: `Project description ['${baseValues.project_description}']`,
        filter: (val) => val.trim(),
        validate: (val) => val.length !== 0
    },
    {
        type: "input",
        name: "namespace",
        message: `Namespace ['${baseValues.namespace}']`,
        filter: (val) => pascalCase(val.trim()),
        validate: (val) => val.length !== 0
    },
    {
        type: "input",
        name: "const_prefix",
        message: `Constant prefix ['${baseValues.const_prefix}']`,
        filter: (val) => constantCase(val.trim()),
        validate: (val) => val.length !== 0
    },
    {
        type: "input",
        name: "text_domain",
        message: `Text domain ['${baseValues.text_domain}']`,
        filter: (val) => paramCase(val.trim()),
        validate: (val) => val.length !== 0
    },
    {
        type: "input",
        name: "author",
        message: `Author name ['${baseValues.author}']`,
        filter: (val) => val.trim(),
        validate: (val) => val.length !== 0
    },
    {
        type: "input",
        name: "author_url",
        message: `Author URL ['${baseValues.author_url}']`,
        filter: (val) => val.trim(),
        validate: (val) => val.length !== 0
    },
    {
        type: "input",
        name: "git_repository",
        message: `Git repository URL ['${baseValues.git_repository}']`,
        filter: (val) => val.trim().toLowerCase(),
        validate: (val) => val.length !== 0
    },
]).then((answers) => {
    const replaceSummary = {
        [baseValues.project_name]: answers.project_name,
        [baseValues.project_description]: answers.project_description,
        [baseValues.namespace]: answers.namespace,
        [baseValues.const_prefix]: answers.const_prefix,
        [baseValues.text_domain]: answers.text_domain,
        [baseValues.author]: answers.author,
        [baseValues.author_url]: answers.author_url,
        [baseValues.git_repository]: answers.git_repository
    };

    log("");
    log("Enqueued changes:");
    log("---------------------------");
    log(`- ${chalk.redBright(baseValues.project_name)} => ${chalk.greenBright(answers.project_name)}`);
    log(`- ${chalk.redBright(baseValues.namespace)} => ${chalk.green(answers.namespace)}`);
    log(`- ${chalk.redBright(baseValues.const_prefix)} => ${chalk.green(answers.const_prefix)}`);
    log(`- ${chalk.redBright(baseValues.text_domain)} => ${chalk.green(answers.text_domain)}`);
    log("---------------------------");
    log("");
    log("Project info:");
    log("---------------------------");
    log(`Theme description: ${chalk.blueBright(answers.project_description)}`)
    log(`Theme URL/Git repository: ${chalk.blueBright(answers.git_repository)}`)
    log(`Author name: ${chalk.blueBright(answers.author)}`)
    log(`Author URL: ${chalk.blueBright(answers.author_url)}`)
    log("---------------------------");
    log("");
    log(`${chalk.yellowBright("!! WARNING !! ")} This is a one-time step. Once applied, it cannot be undone or updated automatically.`);
    log("");

    inquirer.prompt([
        {
            type: "confirm",
            default: false,
            name: "confirm",
            message: "Are you sure you wish to proceed?"
        }
    ]).then((confirm) => {
        if(!confirm.confirm){
            throw new Error("Rebrand cancelled");
        }

        log("Rebranding your project...");

        const ignoredFiles = [
            path.resolve(path.dirname(__dirname), "build"),
            path.resolve(path.dirname(__dirname), "includes/plugins"),
            path.resolve(path.dirname(__dirname), "node_modules"),
            path.resolve(path.dirname(__dirname), "assets/dist"),
            path.resolve(path.dirname(__dirname), "vendor"),
        ];
        
        const matchFiles = [
            path.resolve(path.dirname(__dirname), "style.css"),
            path.resolve(path.dirname(__dirname), "**/*.php"),
            path.resolve(path.dirname(__dirname), "**/*.md"),
            path.resolve(path.dirname(__dirname), "**/*.txt"),
            path.resolve(path.dirname(__dirname), "**/*.json"),
            path.resolve(path.dirname(__dirname), "**/*.xml"),
            path.resolve(path.dirname(__dirname), "assets/src/**/*.scss"),
            path.resolve(path.dirname(__dirname), "assets/src/**/*.js"),
            path.resolve(path.dirname(__dirname), "lang/*.pot"),
        ];

        for(const from in replaceSummary){
            var to = replaceSummary[from];

            replace.sync({
                ignore: ignoredFiles,
                files: matchFiles,
                from: new RegExp(from, 'g'),
                to
            });
        }

        log(`${chalk.greenBright("Done! :-)")}`)
    });
});