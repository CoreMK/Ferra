import { FileBlob, SpreadsheetFile } from '@oai/artifact-tool';
const wb = await SpreadsheetFile.importXlsx(await FileBlob.load(process.argv[2]));
console.log((await wb.inspect({kind:'workbook,sheet,table',maxChars:16000,tableMaxRows:30,tableMaxCols:24})).ndjson);
