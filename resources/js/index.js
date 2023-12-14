import 'table2excel';

document.addEventListener('alpine:init', () => {
    window.Alpine.magic('printReport', () => {
        return () => {
            print()
        }
    })
    window.Alpine.magic('exportToExcel', () => {
        return () => {
            let table2excel = new Table2Excel();
            let element = document.getElementById("fi-report");
            table2excel.export(element, "report.xlsx")
        }
    })
})
